@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="ui-title text-3xl font-extrabold text-slate-900">Lending Library</h1>
        @auth
            <a href="{{ route('books.create') }}" class="btn-primary">
                Add to Shelf
            </a>
        @endauth
    </div>

    @if ($books->count() === 0)
        <div class="ui-panel p-8 text-center text-slate-600">
            No lendable books found yet.
        </div>
    @else
        <div class="stagger grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($books as $book)
                <article class="ui-panel overflow-hidden transition hover:-translate-y-0.5 hover:shadow-lg">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="book-cover-frame flex h-48 items-center justify-center text-sm font-semibold text-slate-500">
                            <span class="book-cover-spine"></span>
                            <span class="px-6">No Cover Image</span>
                        </div>
                    @endif

                    <div class="p-4">
                        <div class="mb-3 flex items-center justify-between gap-2">
                            <span class="book-tag">{{ $book->status === 'available' ? 'Available to Borrow' : 'Currently Lent' }}</span>
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ str_replace('_', ' ', ucfirst($book->condition)) }}</span>
                        </div>
                        <h2 class="ui-title text-xl font-extrabold text-slate-900">{{ $book->title }}</h2>
                        <p class="mt-1 text-sm text-slate-600">by {{ $book->author }}</p>
                        <p class="mt-2 text-sm text-slate-600">Lending: {{ $book->status === 'available' ? 'Ready for a borrower' : 'On loan right now' }}</p>
                        <p class="mt-1 text-xs font-medium text-slate-500">Owner: {{ $book->user->name }}</p>

                        <a href="{{ route('books.show', $book->id) }}" class="btn-linkish mt-4 inline-block text-sm font-bold hover:underline">
                            Open Book
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $books->links() }}
        </div>
    @endif
@endsection
