@extends('layouts.app')

@section('content')
    <div class="mx-auto w-full max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-semibold text-gray-900">Add Book</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="mb-1 block text-sm font-medium text-gray-700">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none" />
            </div>

            <div>
                <label for="author" class="mb-1 block text-sm font-medium text-gray-700">Author</label>
                <input id="author" name="author" type="text" value="{{ old('author') }}" required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none" />
            </div>

            <div>
                <label for="description" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="condition" class="mb-1 block text-sm font-medium text-gray-700">Condition</label>
                <select id="condition" name="condition" required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none">
                    <option value="">Select condition</option>
                    <option value="new" @selected(old('condition') === 'new')>New</option>
                    <option value="like_new" @selected(old('condition') === 'like_new')>Like New</option>
                    <option value="good" @selected(old('condition') === 'good')>Good</option>
                    <option value="fair" @selected(old('condition') === 'fair')>Fair</option>
                </select>
            </div>

            <div>
                <label for="image" class="mb-1 block text-sm font-medium text-gray-700">Image</label>
                <input id="image" name="image" type="file" accept="image/*"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm file:mr-4 file:rounded file:border-0 file:bg-gray-100 file:px-3 file:py-2" />
                <p class="mt-1 text-xs text-gray-500">Optional. JPG, PNG, WEBP. Max 2MB.</p>
            </div>

            <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">
                Save Book
            </button>
        </form>
    </div>
@endsection
