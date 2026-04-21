@extends('layouts.app')

@section('content')
    <div class="ui-panel mx-auto max-w-3xl p-6 sm:p-8">
        <div class="mb-4 border-b border-slate-200 pb-4">
            <h1 class="ui-title text-2xl font-extrabold text-slate-900">Conversation</h1>
            <p class="mt-1 text-sm text-slate-600">
                Book: <span class="font-semibold text-slate-800">{{ $exchangeRequest->book->title }}</span>
            </p>
            <p class="text-sm text-slate-600">
                {{ $exchangeRequest->owner->name }} and {{ $exchangeRequest->requester->name }}
            </p>
        </div>

        <div class="max-h-104 space-y-3 overflow-y-auto rounded-xl border border-slate-200 bg-slate-50 p-4">
            @forelse ($exchangeRequest->messages as $chatMessage)
                @php
                    $isMine = $chatMessage->sender_id === auth()->id();
                @endphp

                <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                    <article class="max-w-[85%] rounded-2xl px-4 py-3 text-sm shadow-sm {{ $isMine ? 'bg-teal-600 text-white' : 'bg-white text-slate-800 border border-slate-200' }}">
                        <p>{{ $chatMessage->body }}</p>
                        <p class="mt-2 text-[11px] {{ $isMine ? 'text-teal-100' : 'text-slate-400' }}">
                            {{ $chatMessage->sender->name }} • {{ $chatMessage->created_at->format('M d, h:i A') }}
                        </p>
                    </article>
                </div>
            @empty
                <p class="text-sm text-slate-600">No messages yet. Start the conversation below.</p>
            @endforelse
        </div>

        <form action="{{ route('messages.store', $exchangeRequest) }}" method="POST" class="mt-4 space-y-3">
            @csrf
            <div>
                <label for="body" class="field-label">Your Message</label>
                <textarea id="body" name="body" rows="3" required class="field-input" placeholder="Write a message...">{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">Send Message</button>
                <a href="{{ route('requests.index') }}" class="btn-secondary">Back to Requests</a>
            </div>
        </form>
    </div>
@endsection
