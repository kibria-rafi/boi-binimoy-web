@extends('layouts.app')

@section('content')
    <div class="ui-panel mx-auto max-w-2xl p-8">
        <h1 class="ui-title text-3xl font-extrabold text-slate-900">Profile</h1>
        <p class="ui-subtle mt-2">Your public account details.</p>

        <dl class="mt-6 space-y-4">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Name</dt>
                <dd class="mt-1 text-base font-semibold text-slate-900">{{ auth()->user()->name }}</dd>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Email</dt>
                <dd class="mt-1 text-base font-semibold text-slate-900">{{ auth()->user()->email }}</dd>
            </div>
        </dl>
    </div>
@endsection
