@extends('layouts.app')

@section('content')
    <div class="rounded-lg border border-gray-200 bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>
        <p class="mt-3 text-gray-600"><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p class="mt-1 text-gray-600"><strong>Email:</strong> {{ auth()->user()->email }}</p>
    </div>
@endsection
