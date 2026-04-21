@extends('layouts.app')

@section('content')
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid gap-0 md:grid-cols-2">
            <div class="bg-gray-100">
                @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="h-full w-full object-cover">
                @else
                    <div class="flex h-72 items-center justify-center text-sm text-gray-500">No Image Available</div>
                @endif
            </div>

            <div class="p-6">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $book->title }}</h1>
                <p class="mt-1 text-gray-600">by {{ $book->author }}</p>

                <p class="mt-4 text-sm text-gray-700"><strong>Condition:</strong> {{ str_replace('_', ' ', ucfirst($book->condition)) }}</p>
                <p class="mt-1 text-sm text-gray-700"><strong>Status:</strong> {{ ucfirst($book->status) }}</p>
                <p class="mt-1 text-sm text-gray-700"><strong>Owner:</strong> {{ $book->user->name }}</p>

                <div class="mt-4 border-t border-gray-200 pt-4">
                    <h2 class="text-sm font-semibold text-gray-900">Description</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-700">{{ $book->description }}</p>
                </div>

                @auth
                    @if (auth()->id() === $book->user_id)
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="mt-5" onsubmit="return confirm('Are you sure you want to delete this book?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                                Delete Book
                            </button>
                        </form>
                    @endif

                    @if (auth()->id() !== $book->user_id)
                        <div class="mt-5 rounded-md border border-gray-200 bg-gray-50 p-4">
                            <h2 class="text-sm font-semibold text-gray-900">Request Exchange</h2>

                            @if ($book->status === 'available')
                                <form action="{{ route('requests.send', $book->id) }}" method="POST" class="mt-3 space-y-3">
                                    @csrf
                                    <div>
                                        <label for="message" class="mb-1 block text-sm font-medium text-gray-700">Message (optional)</label>
                                        <textarea id="message" name="message" rows="3"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none"
                                            placeholder="I would like to exchange this book.">{{ old('message') }}</textarea>
                                    </div>
                                    <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">
                                        Request Exchange
                                    </button>
                                </form>
                            @else
                                <p class="mt-2 text-sm text-gray-600">This book is already exchanged and cannot receive new requests.</p>
                            @endif
                        </div>
                    @endif
                @endauth

                <a href="{{ route('books.index') }}" class="mt-6 inline-block text-sm font-medium text-gray-900 hover:underline">
                    Back to Books
                </a>
            </div>
        </div>
    </div>
@endsection
