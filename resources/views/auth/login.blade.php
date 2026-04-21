@extends('layouts.app')

@section('content')
    <div class="ui-panel mx-auto w-full max-w-md p-7 sm:p-8">
        <h1 class="ui-title mb-2 text-3xl font-extrabold text-slate-900">Welcome Back</h1>
        <p class="ui-subtle mb-6 text-sm">Login to manage your books and exchange requests.</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="field-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="field-input" />
            </div>

            <div>
                <label for="password" class="field-label">Password</label>
                <input id="password" name="password" type="password" required
                    class="field-input" />
            </div>

            <label class="flex items-center gap-2 text-sm font-medium text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300" />
                Remember me
            </label>

            <button type="submit" class="btn-primary w-full">
                Login
            </button>
        </form>

        <p class="mt-4 text-sm text-slate-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-bold text-teal-700 hover:underline">Register</a>
        </p>
    </div>
@endsection
