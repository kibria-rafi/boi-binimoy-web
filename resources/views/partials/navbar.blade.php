<header class="relative z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur">
    <nav class="mx-auto w-full max-w-7xl px-4 py-4 sm:px-6 lg:px-10">
        @php
            $isBrowseActive = request()->routeIs('books.index') || request()->routeIs('books.show');
            $isAddBookActive = request()->routeIs('books.create');
            $isRequestsActive = request()->routeIs('requests.*') || request()->routeIs('messages.*');
            $isDashboardActive = request()->routeIs('dashboard');
            $isProfileActive = request()->routeIs('profile');
        @endphp

        <div class="flex items-center justify-between gap-3 lg:gap-6">
            <a href="{{ route('home') }}" class="ui-title flex shrink-0 items-center text-xl font-extrabold tracking-tight text-slate-900">
                <span>Boi Binimoy</span>
                <span class="ml-2 rounded-full bg-amber-100 px-2 py-0.5 text-xs font-bold text-amber-800">Exchange</span>
            </a>

            <details class="relative z-50 lg:hidden">
                <summary class="btn-secondary cursor-pointer list-none">Menu</summary>
                <div class="ui-panel absolute right-0 z-60 mt-3 grid w-64 gap-2 p-3 text-sm font-semibold text-slate-700 sm:w-72">
                    <a href="{{ route('books.index') }}" class="{{ $isBrowseActive ? 'btn-primary' : 'btn-secondary' }} w-full">Browse Books</a>

                    @guest
                        <a href="{{ route('login') }}" class="btn-secondary w-full">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary w-full">Register</a>
                    @endguest

                    @auth
                        <a href="{{ route('books.create') }}" class="{{ $isAddBookActive ? 'btn-primary' : 'btn-secondary' }} w-full">Add Book</a>
                        <a href="{{ route('requests.index') }}" class="{{ $isRequestsActive ? 'btn-primary' : 'btn-secondary' }} w-full">Requests</a>
                        <a href="{{ route('dashboard') }}" class="{{ $isDashboardActive ? 'btn-primary' : 'btn-secondary' }} w-full">Dashboard</a>
                        <a href="{{ route('profile') }}" class="{{ $isProfileActive ? 'btn-primary' : 'btn-secondary' }} w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4">
                                <circle cx="12" cy="8" r="3.5"></circle>
                                <path d="M4.5 19.5c1.8-3.1 4.4-4.5 7.5-4.5s5.7 1.4 7.5 4.5"></path>
                            </svg>
                            Profile
                        </a>
                    @endauth
                </div>
            </details>

            <div class="hidden items-center justify-end gap-2 text-sm font-semibold text-slate-600 lg:ml-auto lg:flex">
                <a href="{{ route('books.index') }}" class="{{ $isBrowseActive ? 'btn-primary' : 'btn-secondary' }}">Browse Books</a>

                @guest
                    <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary">Register</a>
                @endguest

                @auth
                    <a href="{{ route('books.create') }}" class="{{ $isAddBookActive ? 'btn-primary' : 'btn-secondary' }}">Add Book</a>
                    <a href="{{ route('requests.index') }}" class="{{ $isRequestsActive ? 'btn-primary' : 'btn-secondary' }}">Requests</a>
                    <a href="{{ route('dashboard') }}" class="{{ $isDashboardActive ? 'btn-primary' : 'btn-secondary' }}">Dashboard</a>
                    <a href="{{ route('profile') }}" class="{{ $isProfileActive ? 'btn-primary' : 'btn-secondary' }}" aria-label="Profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="16" height="16" class="shrink-0">
                            <circle cx="12" cy="8" r="3.5"></circle>
                            <path d="M4.5 19.5c1.8-3.1 4.4-4.5 7.5-4.5s5.7 1.4 7.5 4.5"></path>
                        </svg>
                        <span>Profile</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>
</header>
