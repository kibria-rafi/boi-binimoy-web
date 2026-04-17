<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ExchangeRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function sendRequest(HttpRequest $request, int $book_id): RedirectResponse
    {
        $request->validate([
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $book = Book::findOrFail($book_id);

        return $this->createExchangeRequest($book, $request->user()->id, $request->input('message'));
    }

    public function store(HttpRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $book = Book::findOrFail($validated['book_id']);

        return $this->createExchangeRequest($book, $request->user()->id, $validated['message'] ?? null);
    }

    public function incomingRequests(HttpRequest $request): View
    {
        $incomingRequests = ExchangeRequest::with(['book', 'requester'])
            ->where('owner_id', $request->user()->id)
            ->latest()
            ->get();

        $outgoingRequests = $this->outgoingRequests($request);

        return view('requests.index', compact('incomingRequests', 'outgoingRequests'));
    }

    public function outgoingRequests(HttpRequest $request): Collection
    {
        return ExchangeRequest::with(['book', 'owner'])
            ->where('requester_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function accept(HttpRequest $request, int $id): RedirectResponse
    {
        $exchangeRequest = ExchangeRequest::with('book')
            ->where('owner_id', $request->user()->id)
            ->findOrFail($id);

        if ($exchangeRequest->status !== 'pending') {
            return back()->withErrors(['request' => 'Only pending requests can be accepted.']);
        }

        DB::transaction(function () use ($exchangeRequest) {
            $exchangeRequest->update(['status' => 'accepted']);
            $exchangeRequest->book()->update(['status' => 'exchanged']);

            ExchangeRequest::query()
                ->where('book_id', $exchangeRequest->book_id)
                ->where('id', '!=', $exchangeRequest->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        });

        return back()->with('success', 'Request accepted successfully.');
    }

    public function reject(HttpRequest $request, int $id): RedirectResponse
    {
        $exchangeRequest = ExchangeRequest::query()
            ->where('owner_id', $request->user()->id)
            ->findOrFail($id);

        if ($exchangeRequest->status !== 'pending') {
            return back()->withErrors(['request' => 'Only pending requests can be rejected.']);
        }

        $exchangeRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected successfully.');
    }

    private function createExchangeRequest(Book $book, int $requesterId, ?string $message): RedirectResponse
    {
        if ($book->user_id === $requesterId) {
            return back()->withErrors(['request' => 'You cannot request your own book.']);
        }

        if ($book->status === 'exchanged') {
            return back()->withErrors(['request' => 'This book has already been exchanged.']);
        }

        $alreadyPending = ExchangeRequest::query()
            ->where('book_id', $book->id)
            ->where('requester_id', $requesterId)
            ->where('status', 'pending')
            ->exists();

        if ($alreadyPending) {
            return back()->withErrors(['request' => 'You already sent a pending request for this book.']);
        }

        ExchangeRequest::create([
            'book_id' => $book->id,
            'requester_id' => $requesterId,
            'owner_id' => $book->user_id,
            'status' => 'pending',
            'message' => $message,
        ]);

        return redirect()->route('requests.index')->with('success', 'Exchange request sent.');
    }
}
