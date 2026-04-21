@extends('layouts.app')

@section('content')
    <section class="ui-panel overflow-hidden p-8 sm:p-10">
        <div class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
            <div>
                <p class="mb-3 inline-block rounded-full bg-teal-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-teal-800">Community Shelf</p>
                <h1 class="ui-title text-4xl font-extrabold text-slate-900 sm:text-5xl">Give Your Books a Second Life</h1>
                <p class="ui-subtle mt-4 max-w-xl text-base leading-7">
                    Boi Binimoy helps readers exchange books with people nearby. List your books, discover titles, and build a reading community without spending extra money.
                </p>

                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('books.index') }}" class="btn-primary">Explore Books</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-secondary">Create Free Account</a>
                    @endguest
                    @auth
                        <a href="{{ route('books.create') }}" class="btn-secondary">Post a Book</a>
                    @endauth
                </div>
            </div>

            <div class="stagger grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-2xl font-extrabold text-slate-900">1</p>
                    <p class="mt-1 text-sm font-semibold text-slate-700">Add your book in minutes</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-2xl font-extrabold text-slate-900">2</p>
                    <p class="mt-1 text-sm font-semibold text-slate-700">Receive exchange requests</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:col-span-2 lg:col-span-1">
                    <p class="text-2xl font-extrabold text-slate-900">3</p>
                    <p class="mt-1 text-sm font-semibold text-slate-700">Approve and exchange safely</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-3">
        <article class="ui-panel p-5">
            <h2 class="ui-title text-lg font-bold text-slate-900">Simple Listing</h2>
            <p class="ui-subtle mt-1 text-sm">Upload cover images, add condition, and publish instantly.</p>
        </article>
        <article class="ui-panel p-5">
            <h2 class="ui-title text-lg font-bold text-slate-900">Trusted Requests</h2>
            <p class="ui-subtle mt-1 text-sm">Manage incoming and outgoing requests from one dashboard.</p>
        </article>
        <article class="ui-panel p-5">
            <h2 class="ui-title text-lg font-bold text-slate-900">Mobile Friendly</h2>
            <p class="ui-subtle mt-1 text-sm">Clean layout designed to work smoothly on phone and desktop.</p>
        </article>
    </section>
@endsection
