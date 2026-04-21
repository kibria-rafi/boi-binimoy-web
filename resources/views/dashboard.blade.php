@extends('layouts.app')

@section('content')
    <div class="ui-panel mb-6 p-8">
        <h1 class="ui-title text-3xl font-extrabold text-slate-900">Dashboard</h1>
        <p class="ui-subtle mt-3">Manage your lending shelf and track borrow activity.</p>
    </div>

    <div class="ui-panel p-6">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 class="ui-title text-2xl font-extrabold text-slate-900">My Lending Shelf</h2>
            <a href="{{ route('books.create') }}" class="btn-primary">Add to Shelf</a>
        </div>

        @if ($books->count() === 0)
            <p class="text-sm text-slate-600">You have not added any books yet.</p>
        @else
            <div class="stagger grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($books as $book)
                    <article class="paper-card rounded-2xl border border-slate-200 p-4 shadow-sm transition hover:-translate-y-0.5">
                        <h3 class="ui-title font-extrabold text-slate-900">{{ $book->title }}</h3>
                        <p class="text-sm text-slate-600">{{ $book->author }}</p>
                        <p class="mt-2 text-xs font-semibold text-slate-600">{{ $book->status === 'available' ? 'Ready to lend' : 'Currently on loan' }}</p>
                        <div class="mt-3 flex items-center gap-3">
                            <a href="{{ route('books.show', $book->id) }}" class="btn-linkish inline-block text-sm font-bold hover:underline">Open Book</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-rose-700 hover:underline">Delete</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@endsection
