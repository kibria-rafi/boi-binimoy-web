<?php

namespace App\Http\Controllers;

use App\Models\ExchangeMessage;
use App\Models\ExchangeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function show(Request $request, ExchangeRequest $exchangeRequest): View
    {
        $exchangeRequest = $this->authorizeParticipantAndAccepted($request, $exchangeRequest);

        $exchangeRequest->load([
            'book',
            'owner',
            'requester',
            'messages' => fn ($query) => $query->with('sender')->oldest(),
        ]);

        return view('messages.show', compact('exchangeRequest'));
    }

    public function store(Request $request, ExchangeRequest $exchangeRequest): RedirectResponse
    {
        $exchangeRequest = $this->authorizeParticipantAndAccepted($request, $exchangeRequest);
        $senderId = $request->user()->id;
        $receiverId = $exchangeRequest->owner_id === $senderId
            ? $exchangeRequest->requester_id
            : $exchangeRequest->owner_id;

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        ExchangeMessage::create([
            'exchange_request_id' => $exchangeRequest->id,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'body' => $validated['body'],
        ]);

        return redirect()->route('messages.show', $exchangeRequest)->with('success', 'Message sent.');
    }

    private function authorizeParticipantAndAccepted(Request $request, ExchangeRequest $exchangeRequest): ExchangeRequest
    {
        $userId = $request->user()->id;

        $isParticipant = $exchangeRequest->owner_id === $userId || $exchangeRequest->requester_id === $userId;

        if (! $isParticipant) {
            abort(403, 'You are not allowed to view this conversation.');
        }

        if ($exchangeRequest->status !== 'accepted') {
            abort(403, 'Messaging is available only for accepted requests.');
        }

        return $exchangeRequest;
    }
}
