<header class="border-b border-slate-200/80 bg-white/90 backdrop-blur">
    <nav class="mx-auto w-full max-w-7xl px-4 py-4 sm:px-6 lg:px-10">
        <div class="flex items-center justify-between gap-3">
        <a href="{{ route('home') }}" class="ui-title text-xl font-extrabold tracking-tight text-slate-900">
            Boi Binimoy
            <span class="ml-2 rounded-full bg-amber-100 px-2 py-0.5 text-xs font-bold text-amber-800">Exchange</span>
        </a>

            <details class="md:hidden">
                <summary class="btn-secondary cursor-pointer list-none">Menu</summary>
                <div class="ui-panel mt-3 grid gap-2 p-3 text-sm font-semibold text-slate-700">
                    <a href="{{ route('books.index') }}" class="btn-secondary w-full">Browse Books</a>

                    @guest
                        <a href="{{ route('login') }}" class="btn-secondary w-full">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary w-full">Register</a>
                    @endguest

                    @auth
                        <a href="{{ route('books.create') }}" class="btn-primary w-full">Add Book</a>
                        <a href="{{ route('requests.index') }}" class="btn-secondary w-full">Requests</a>
                        <a href="{{ route('dashboard') }}" class="btn-secondary w-full">Dashboard</a>
                        <a href="{{ route('profile') }}" class="btn-secondary w-full">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="btn-secondary w-full">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </details>
        </div>

        <div class="hidden flex-wrap items-center justify-end gap-2 pt-3 text-sm font-semibold text-slate-600 md:flex md:pt-0">
            <a href="{{ route('books.index') }}" class="btn-secondary">Browse Books</a>

            @guest
                <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                <a href="{{ route('register') }}" class="btn-primary">Register</a>
            @endguest

            @auth
                <a href="{{ route('books.create') }}" class="btn-primary">Add Book</a>
                <a href="{{ route('requests.index') }}" class="btn-secondary">Requests</a>
                <a href="{{ route('dashboard') }}" class="btn-secondary">Dashboard</a>
                <a href="{{ route('profile') }}" class="btn-secondary">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </nav>
</header>
