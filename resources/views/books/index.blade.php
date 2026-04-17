@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">All Books</h1>
        @auth
            <a href="{{ route('books.create') }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">
                Add Book
            </a>
        @endauth
    </div>

    @if ($books->count() === 0)
        <div class="rounded-lg border border-gray-200 bg-white p-8 text-center text-gray-600 shadow-sm">
            No books found yet.
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($books as $book)
                <article class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="flex h-48 items-center justify-center bg-gray-100 text-sm text-gray-500">No Image</div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $book->title }}</h2>
                        <p class="mt-1 text-sm text-gray-600">by {{ $book->author }}</p>
                        <p class="mt-2 text-sm text-gray-600">Condition: {{ str_replace('_', ' ', ucfirst($book->condition)) }}</p>
                        <p class="mt-1 text-sm text-gray-600">Status: {{ ucfirst($book->status) }}</p>
                        <p class="mt-1 text-xs text-gray-500">Owner: {{ $book->user->name }}</p>

                        <a href="{{ route('books.show', $book->id) }}" class="mt-4 inline-block text-sm font-medium text-gray-900 hover:underline">
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
