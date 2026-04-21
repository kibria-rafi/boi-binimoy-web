@extends('layouts.app')

@section('content')
    <div class="ui-panel mx-auto w-full max-w-md p-7 sm:p-8">
        <h1 class="ui-title mb-2 text-3xl font-extrabold text-slate-900">Create Account</h1>
        <p class="ui-subtle mb-6 text-sm">Join and start exchanging books with your community.</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="field-label">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    class="field-input" />
            </div>

            <div>
                <label for="email" class="field-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="field-input" />
            </div>

            <div>
                <label for="password" class="field-label">Password</label>
                <input id="password" name="password" type="password" required
                    class="field-input" />
            </div>

            <div>
                <label for="password_confirmation" class="field-label">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="field-input" />
            </div>

            <button type="submit" class="btn-primary w-full">
                Register
            </button>
        </form>

        <p class="mt-4 text-sm text-slate-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-teal-700 hover:underline">Login</a>
        </p>
    </div>
@endsection
