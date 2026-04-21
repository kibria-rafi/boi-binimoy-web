@extends('layouts.app')

@section('content')
    <div class="ui-panel mx-auto w-full max-w-2xl p-7 sm:p-8">
        <h1 class="ui-title mb-2 text-3xl font-extrabold text-slate-900">Add Book</h1>
        <p class="ui-subtle mb-6 text-sm">Fill in details so others can discover and request your book.</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="field-label">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                    class="field-input" />
            </div>

            <div>
                <label for="author" class="field-label">Author</label>
                <input id="author" name="author" type="text" value="{{ old('author') }}" required
                    class="field-input" />
            </div>

            <div>
                <label for="description" class="field-label">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="field-input">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="condition" class="field-label">Condition</label>
                <select id="condition" name="condition" required
                    class="field-input">
                    <option value="">Select condition</option>
                    <option value="new" @selected(old('condition') === 'new')>New</option>
                    <option value="like_new" @selected(old('condition') === 'like_new')>Like New</option>
                    <option value="good" @selected(old('condition') === 'good')>Good</option>
                    <option value="fair" @selected(old('condition') === 'fair')>Fair</option>
                </select>
            </div>

            <div>
                <label for="image" class="field-label">Image</label>
                <input id="image" name="image" type="file" accept="image/*"
                    class="field-input" />
                <p class="mt-1 text-xs font-medium text-slate-500">Optional. JPG, PNG, WEBP. Max 2MB.</p>
            </div>

            <button type="submit" class="btn-primary">
                Save Book
            </button>
        </form>
    </div>
@endsection
