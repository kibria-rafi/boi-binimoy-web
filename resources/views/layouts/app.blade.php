<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Boi Binimoy') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell min-h-screen antialiased">
    @include('partials.navbar')

    <main class="page-enter mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-10">
        @if (session('success'))
            <div class="ui-panel mb-6 border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
