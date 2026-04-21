@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="ui-title text-3xl font-extrabold text-slate-900">Explore Books</h1>
        @auth
            <a href="{{ route('books.create') }}" class="btn-primary">
                Add Book
            </a>
        @endauth
    </div>

    @if ($books->count() === 0)
        <div class="ui-panel p-8 text-center text-slate-600">
            No books found yet.
        </div>
    @else
        <div class="stagger grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($books as $book)
                <article class="ui-panel overflow-hidden transition hover:-translate-y-0.5 hover:shadow-lg">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="flex h-48 items-center justify-center bg-slate-100 text-sm font-semibold text-slate-500">No Image</div>
                    @endif

                    <div class="p-4">
                        <h2 class="ui-title text-xl font-extrabold text-slate-900">{{ $book->title }}</h2>
                        <p class="mt-1 text-sm text-slate-600">by {{ $book->author }}</p>
                        <p class="mt-2 text-sm text-slate-600">Condition: {{ str_replace('_', ' ', ucfirst($book->condition)) }}</p>
                        <p class="mt-1 text-sm text-slate-600">Status: {{ ucfirst($book->status) }}</p>
                        <p class="mt-1 text-xs font-medium text-slate-500">Owner: {{ $book->user->name }}</p>

                        <a href="{{ route('books.show', $book->id) }}" class="btn-linkish mt-4 inline-block text-sm font-bold hover:underline">
                            View Details
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
