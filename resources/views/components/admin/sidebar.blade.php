<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 lg:translate-x-0">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-900' : 'text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.dashboard') ? 'text-primary-700' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- Test Sections -->
            <li>
                <a href="{{ route('admin.sections.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.sections.*') ? 'bg-primary-50 text-primary-900' : 'text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.sections.*') ? 'text-primary-700' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <span class="ml-3">Test Sections</span>
                </a>
            </li>

            <!-- Questions -->
            <li>
                <a href="{{ route('admin.questions.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.questions.*') ? 'bg-primary-50 text-primary-900' : 'text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.questions.*') ? 'text-primary-700' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-3">Questions</span>
                </a>
            </li>

            <!-- Test Versions -->
            <li>
                <a href="{{ route('admin.test-versions.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.test-versions.*') ? 'bg-primary-50 text-primary-900' : 'text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.test-versions.*') ? 'text-primary-700' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="ml-3">Test Versions</span>
                </a>
            </li>

            <!-- Candidates -->
            <li>
                <a href="{{ route('admin.candidates.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.candidates.*') ? 'bg-primary-50 text-primary-900' : 'text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.candidates.*') ? 'text-primary-700' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="ml-3">Candidates</span>
                </a>
            </li>

            <!-- Reports -->
            <li>
                <a href="{{ route('admin.reports.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.reports.*') ? 'bg-primary-50 text-primary-900' : 'text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.reports.*') ? 'text-primary-700' : 'text-gray-500 group-hover:text-gray-900' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="ml-3">Reports</span>
                </a>
            </li>
        </ul>

        <!-- Divider -->
        <div class="pt-4 mt-4 space-y-2 border-t border-gray-200">
            <a href="{{ route('home') }}" target="_blank"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-3">Public Portal</span>
                <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </div>
</aside>