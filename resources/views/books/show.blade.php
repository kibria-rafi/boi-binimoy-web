@extends('layouts.app')

@section('content')
    <div class="ui-panel overflow-hidden">
        <div class="grid gap-0 md:grid-cols-2">
            <div class="bg-slate-100">
                @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="h-full w-full object-cover">
                @else
                    <div class="book-cover-frame flex h-72 items-center justify-center text-sm font-semibold text-slate-500">
                        <span class="book-cover-spine"></span>
                        <span class="px-6">No Cover Image Available</span>
                    </div>
                @endif
            </div>

            <div class="paper-card p-6">
                <div class="mb-4 flex items-center gap-2">
                    <span class="book-tag">{{ $book->status === 'available' ? 'Borrowable' : 'On Loan' }}</span>
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ str_replace('_', ' ', ucfirst($book->condition)) }}</span>
                </div>
                <h1 class="ui-title text-3xl font-extrabold text-slate-900">{{ $book->title }}</h1>
                <p class="mt-1 text-slate-600">by {{ $book->author }}</p>

                <p class="mt-4 text-sm font-medium text-slate-700"><strong>Condition:</strong> {{ str_replace('_', ' ', ucfirst($book->condition)) }}</p>
                <p class="mt-1 text-sm font-medium text-slate-700"><strong>Availability:</strong> {{ $book->status === 'available' ? 'Ready to lend' : 'Currently on loan' }}</p>
                <p class="mt-1 text-sm font-medium text-slate-700"><strong>Shelf owner:</strong> {{ $book->user->name }}</p>

                <div class="mt-4 border-t border-slate-200 pt-4">
                    <h2 class="text-sm font-bold text-slate-900">Description</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-700">{{ $book->description }}</p>
                </div>

                @auth
                    @if (auth()->id() === $book->user_id)
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="mt-5" onsubmit="return confirm('Are you sure you want to delete this book?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">
                                Delete Book
                            </button>
                        </form>
                    @endif

                    @if (auth()->id() !== $book->user_id)
                        <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <h2 class="text-sm font-bold text-slate-900">Request to Borrow</h2>

                            @if ($book->status === 'available')
                                <form action="{{ route('requests.send', $book->id) }}" method="POST" class="mt-3 space-y-3">
                                    @csrf
                                    <div>
                                        <label for="message" class="field-label">Message (optional)</label>
                                        <textarea id="message" name="message" rows="3"
                                            class="field-input"
                                            placeholder="I would like to borrow this book.">{{ old('message') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn-primary">
                                        Send Borrow Request
                                    </button>
                                </form>
                            @else
                                <p class="mt-2 text-sm text-slate-600">This book is currently lent out and cannot receive new requests.</p>
                            @endif
                        </div>
                    @endif
                @endauth

                <a href="{{ route('books.index') }}" class="btn-linkish mt-6 inline-block text-sm font-bold hover:underline">
                    Back to Books
                </a>
            </div>
        </div>
    </div>
@endsection
