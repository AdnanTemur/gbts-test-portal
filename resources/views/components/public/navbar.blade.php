<nav class="sticky top-0 z-50 border-b border-primary-700/20"
    style="background: linear-gradient(135deg, rgba(16,120,71,0.78) 0%, rgba(15,150,84,0.72) 50%, rgba(16,120,71,0.78) 100%); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Left: Logo + Brand -->
            <div class="flex items-center gap-3">
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/15 border border-white/25 shadow-inner">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="leading-tight">
                    <div class="text-base font-bold text-white tracking-wide">
                        {{ config('app.name', 'GBTS Test Portal') }}
                    </div>
                    <div class="text-[11px] text-white/60 font-medium tracking-widest uppercase">
                        Gilgit-Baltistan Testing Service
                    </div>
                </div>
            </div>

            <!-- Right: Admin Info + Logout -->
            <div class="flex items-center gap-2">
                @auth
                    <div
                        class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/10 border border-white/20">
                        <div
                            class="w-7 h-7 rounded-full bg-white/20 border border-white/30 flex items-center justify-center">
                            <span class="text-xs font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <span class="text-sm font-medium text-white/90">
                            {{ auth()->user()->name }}
                        </span>
                    </div>

                    <div class="hidden sm:block w-px h-5 bg-white/20"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition-all border border-transparent hover:border-white/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</nav>