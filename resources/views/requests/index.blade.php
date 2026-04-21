@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="ui-panel mb-8 p-6">
        <p class="book-tag mb-2">Lending Desk</p>
        <h1 class="ui-title text-3xl font-extrabold text-slate-900">Incoming Borrow Requests</h1>
        <p class="mt-1 text-sm text-slate-600">Borrow requests waiting on your lending shelf.</p>

        @if ($incomingRequests->isEmpty())
            <p class="mt-4 text-sm text-slate-600">No incoming borrow requests yet.</p>
        @else
            <div class="mt-4 space-y-3 md:hidden">
                @foreach ($incomingRequests as $request)
                    @php
                        $incomingBadgeClass = match ($request->status) {
                            'accepted' => 'bg-green-100 text-green-700',
                            'rejected' => 'bg-red-100 text-red-700',
                            default => 'bg-yellow-100 text-yellow-700',
                        };
                    @endphp

                    <article class="paper-card rounded-xl border border-slate-200 p-4 shadow-sm">
                        <p class="text-base font-bold text-slate-900">{{ $request->book->title }}</p>
                        <p class="mt-1 text-sm text-slate-600">Requester: {{ $request->requester->name }}</p>
                        <p class="mt-2 text-sm text-slate-600">{{ $request->message ?: '-' }}</p>
                        <span class="{{ $incomingBadgeClass }} mt-3 inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                            {{ ucfirst($request->status) }}
                        </span>

                        @if ($request->status === 'pending')
                            <div class="mt-3 grid grid-cols-2 gap-2">
                                <form action="{{ route('requests.accept', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full rounded-md bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-700">Accept</button>
                                </form>
                                <form action="{{ route('requests.reject', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full rounded-md bg-rose-600 px-3 py-2 text-xs font-semibold text-white hover:bg-rose-700">Reject</button>
                                </form>
                            </div>
                        @elseif ($request->status === 'accepted')
                            <a href="{{ route('messages.show', $request) }}" class="mt-3 inline-flex rounded-md bg-teal-600 px-3 py-2 text-xs font-semibold text-white hover:bg-teal-700">
                                Message
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>

            <div class="mt-4 hidden overflow-x-auto md:block">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Book</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Requester</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Message</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Status</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($incomingRequests as $request)
                            <tr>
                                <td class="px-4 py-3">{{ $request->book->title }}</td>
                                <td class="px-4 py-3">{{ $request->requester->name }}</td>
                                <td class="px-4 py-3">{{ $request->message ?: '-' }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $incomingBadgeClass = match ($request->status) {
                                            'accepted' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            default => 'bg-yellow-100 text-yellow-700',
                                        };
                                    @endphp
                                    <span class="{{ $incomingBadgeClass }} rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($request->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="{{ route('requests.accept', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-700">Accept</button>
                                            </form>
                                            <form action="{{ route('requests.reject', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="rounded-md bg-rose-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-rose-700">Reject</button>
                                            </form>
                                        </div>
                                    @elseif ($request->status === 'accepted')
                                        <a href="{{ route('messages.show', $request) }}" class="inline-flex rounded-md bg-teal-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-teal-700">
                                            Message
                                        </a>
                                    @else
                                        <span class="text-xs font-medium text-slate-500">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="ui-panel p-6">
        <p class="book-tag mb-2">Borrow Log</p>
        <h2 class="ui-title text-2xl font-extrabold text-slate-900">My Borrow Requests</h2>
        <p class="mt-1 text-sm text-slate-600">Requests you sent to borrow books from the community.</p>

        @if ($outgoingRequests->isEmpty())
            <p class="mt-4 text-sm text-slate-600">No borrow requests sent yet.</p>
        @else
            <div class="mt-4 space-y-3 md:hidden">
                @foreach ($outgoingRequests as $request)
                    @php
                        $outgoingBadgeClass = match ($request->status) {
                            'accepted' => 'bg-green-100 text-green-700',
                            'rejected' => 'bg-red-100 text-red-700',
                            default => 'bg-yellow-100 text-yellow-700',
                        };
                    @endphp

                    <article class="paper-card rounded-xl border border-slate-200 p-4 shadow-sm">
                        <p class="text-base font-bold text-slate-900">{{ $request->book->title }}</p>
                        <p class="mt-1 text-sm text-slate-600">Owner: {{ $request->owner->name }}</p>
                        <p class="mt-2 text-sm text-slate-600">{{ $request->message ?: '-' }}</p>
                        <span class="{{ $outgoingBadgeClass }} mt-3 inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                            {{ ucfirst($request->status) }}
                        </span>

                        @if ($request->status === 'accepted')
                            <a href="{{ route('messages.show', $request) }}" class="mt-3 inline-flex rounded-md bg-teal-600 px-3 py-2 text-xs font-semibold text-white hover:bg-teal-700">
                                Message
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>

            <div class="mt-4 hidden overflow-x-auto md:block">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Book</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Owner</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Message</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Status</th>
                            <th class="px-4 py-3 text-left font-bold text-slate-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($outgoingRequests as $request)
                            <tr>
                                <td class="px-4 py-3">{{ $request->book->title }}</td>
                                <td class="px-4 py-3">{{ $request->owner->name }}</td>
                                <td class="px-4 py-3">{{ $request->message ?: '-' }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $outgoingBadgeClass = match ($request->status) {
                                            'accepted' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            default => 'bg-yellow-100 text-yellow-700',
                                        };
                                    @endphp
                                    <span class="{{ $outgoingBadgeClass }} rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($request->status === 'accepted')
                                        <a href="{{ route('messages.show', $request) }}" class="inline-flex rounded-md bg-teal-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-teal-700">
                                            Message
                                        </a>
                                    @else
                                        <span class="text-xs font-medium text-slate-500">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
