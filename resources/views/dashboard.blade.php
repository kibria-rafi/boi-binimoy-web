@extends('layouts.app')

@section('content')
    <div class="mb-6 rounded-lg border border-gray-200 bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        <p class="mt-3 text-gray-600">Manage your books from here.</p>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">My Books</h2>
            <a href="{{ route('books.create') }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">Add Book</a>
        </div>

        @if ($books->count() === 0)
            <p class="text-sm text-gray-600">You have not added any books yet.</p>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($books as $book)
                    <article class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <h3 class="font-semibold text-gray-900">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $book->author }}</p>
                        <p class="mt-2 text-xs text-gray-600">Status: {{ ucfirst($book->status) }}</p>
                        <a href="{{ route('books.show', $book->id) }}" class="mt-2 inline-block text-sm font-medium text-gray-900 hover:underline">View</a>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@endsection
