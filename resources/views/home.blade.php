@extends('layouts.app')

@section('content')
    <section class="ui-panel overflow-hidden p-6 sm:p-8 lg:p-10">
        <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div>
                <p class="book-tag mb-3">Community Library</p>
                <h1 class="ui-title text-4xl font-extrabold text-slate-900 sm:text-5xl">Lend Books. Borrow Stories.</h1>
                <p class="ui-subtle mt-4 max-w-xl text-base leading-7">
                    A warm place for book lovers to lend, borrow, and talk about the stories they share.
                    Post books from your shelf, send borrow requests, and chat after approval.
                </p>

                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('books.index') }}" class="btn-primary">Browse Lending Shelf</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-shelf">Join the Library</a>
                    @endguest
                    @auth
                        <a href="{{ route('books.create') }}" class="btn-shelf">Add to My Shelf</a>
                    @endauth
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-3">
                    <div class="paper-card rounded-2xl border border-slate-200 p-4 shadow-sm">
                        <p class="text-xl font-extrabold text-slate-900">1</p>
                        <p class="mt-1 text-sm font-semibold text-slate-700">List books from your shelf</p>
                    </div>
                    <div class="paper-card rounded-2xl border border-slate-200 p-4 shadow-sm">
                        <p class="text-xl font-extrabold text-slate-900">2</p>
                        <p class="mt-1 text-sm font-semibold text-slate-700">Borrow or lend with trust</p>
                    </div>
                    <div class="paper-card rounded-2xl border border-slate-200 p-4 shadow-sm">
                        <p class="text-xl font-extrabold text-slate-900">3</p>
                        <p class="mt-1 text-sm font-semibold text-slate-700">Chat after requests are accepted</p>
                    </div>
                </div>
            </div>

            <div class="hero-shelf">
                <div class="hero-book one paper-card p-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-amber-900">Available</p>
                    <p class="mt-2 text-lg font-extrabold text-slate-900">The Hobbit</p>
                    <p class="text-sm text-slate-600">by J.R.R. Tolkien</p>
                </div>
                <div class="hero-book two paper-card p-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-amber-900">Borrowed</p>
                    <p class="mt-2 text-lg font-extrabold text-slate-900">Atomic Habits</p>
                    <p class="text-sm text-slate-600">by James Clear</p>
                </div>
                <div class="hero-book three paper-card p-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-amber-900">Message Open</p>
                    <p class="mt-2 text-lg font-extrabold text-slate-900">Before the Coffee Gets Cold</p>
                    <p class="text-sm text-slate-600">by Toshikazu Kawaguchi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-3">
        <article class="ui-panel p-5">
            <h2 class="ui-title text-lg font-bold text-slate-900">Library Style Listing</h2>
            <p class="ui-subtle mt-1 text-sm">Upload cover images, set condition, and publish your lendable copy.</p>
        </article>
        <article class="ui-panel p-5">
            <h2 class="ui-title text-lg font-bold text-slate-900">Trusted Borrow Requests</h2>
            <p class="ui-subtle mt-1 text-sm">Manage incoming and outgoing borrow requests from one dashboard.</p>
        </article>
        <article class="ui-panel p-5">
            <h2 class="ui-title text-lg font-bold text-slate-900">In-App Conversation</h2>
            <p class="ui-subtle mt-1 text-sm">Once accepted, lender and borrower can coordinate through chat.</p>
        </article>
    </section>
@endsection
