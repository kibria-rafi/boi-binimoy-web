<header class="border-b border-gray-200 bg-white">
    <nav class="mx-auto flex w-full max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-900">
            Boi Binimoy
        </a>

        <div class="flex items-center gap-4 text-sm font-medium text-gray-700">
            @guest
                <a href="{{ route('login') }}" class="hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}" class="rounded-md bg-gray-900 px-3 py-2 text-white hover:bg-gray-800">Register</a>
            @endguest

            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                <a href="{{ route('profile') }}" class="hover:text-gray-900">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="rounded-md border border-gray-300 px-3 py-2 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </nav>
</header>
