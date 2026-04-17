@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-8 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold text-gray-900">Incoming Requests</h1>
        <p class="mt-1 text-sm text-gray-600">Requests for books you own.</p>

        @if ($incomingRequests->isEmpty())
            <p class="mt-4 text-sm text-gray-600">No incoming requests yet.</p>
        @else
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Book</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Requester</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Message</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
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
                                                <button type="submit" class="rounded-md bg-green-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-green-700">Accept</button>
                                            </form>
                                            <form action="{{ route('requests.reject', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="rounded-md bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-500">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-gray-900">Outgoing Requests</h2>
        <p class="mt-1 text-sm text-gray-600">Requests sent by you.</p>

        @if ($outgoingRequests->isEmpty())
            <p class="mt-4 text-sm text-gray-600">No outgoing requests yet.</p>
        @else
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Book</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Owner</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Message</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
