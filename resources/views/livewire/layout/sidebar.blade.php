<aside class="w-64 bg-white dark:bg-gray-800 dark:text-white p-4 flex flex-col h-screen overflow-y-auto">
    <!-- Logo/Brand -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">JobFinder</h1>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-grow">
        <ul class="space-y-2">
            <li>
                <a href="{{route('dashboard')}}" wire:navigate class="flex items-center p-2 rounded hover:bg-rose-100 font-medium transition {{ request()->routeIs('dashboard') ? 'bg-rose-600 text-white hover:bg-rose-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{route('MyTeam')}}" wire:navigate class="flex items-center p-2 rounded hover:bg-rose-100 font-medium transition {{ request()->routeIs('MyTeam') ? 'bg-rose-600 text-white hover:bg-rose-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Mi equipo
                </a>
            </li>
            <li>
                <a href="{{route('company.index')}}" wire:navigate class="flex items-center rounded p-2 hover:bg-red-100 font-medium transition {{ request()->routeIs('company.index') ? 'bg-rose-600 text-white hover:bg-rose-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Mis Ofertas
                </a>
            </li>
            <li>
                <a href="{{route('calendar')}}" wire:navigate class="flex items-center p-2 rounded hover:bg-red-100 font-medium transition {{ request()->routeIs('calendar') ? 'bg-rose-600 text-white hover:bg-rose-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Calendario
                </a>
            </li>
            <li>
                <a href="{{route('user.empleos')}}" wire:navigate class="flex items-center p-2 rounded hover:bg-red-100 font-medium transition {{ request()->routeIs('user.empleos') ? 'bg-rose-600 text-white hover:bg-rose-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Empleos
                </a>
            </li>
        </ul>
    </nav>
</aside>