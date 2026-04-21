@extends('layouts.app')

@section('content')
    <div class="ui-panel mx-auto max-w-2xl p-8">
        <p class="book-tag">Library Member</p>
        <h1 class="ui-title mt-3 text-3xl font-extrabold text-slate-900">Profile</h1>
        <p class="ui-subtle mt-2">Your account card for lending and borrowing books.</p>

        <dl class="mt-6 space-y-4">
            <div class="paper-card rounded-xl border border-slate-200 p-4">
                <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Name</dt>
                <dd class="mt-1 text-base font-semibold text-slate-900">{{ auth()->user()->name }}</dd>
            </div>
            <div class="paper-card rounded-xl border border-slate-200 p-4">
                <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Email</dt>
                <dd class="mt-1 text-base font-semibold text-slate-900">{{ auth()->user()->email }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('dashboard') }}" class="btn-secondary">Back to Dashboard</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary">Logout</button>
            </form>
        </div>
    </div>
@endsection
