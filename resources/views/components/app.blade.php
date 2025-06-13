<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clarify - Organize Your Ideas</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <nav class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="/" class="text-xl font-bold text-indigo-600">Clarify</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Dashboard</a>
                        <a href="{{ route('ideas.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('ideas.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Ideas</a>
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('projects.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Projects</a>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('tasks.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Tasks</a>
                    </div>
                </div>
                @auth
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('ideas.create') }}" class="relative inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            New Idea
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="relative ml-3">
                            <div>
                                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <svg class="h-8 w-8 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth
                @guest
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign up</a>
                    @endif
                </div>
                @endguest
            </div>
        </div>
    </nav>

    {{ $slot ?? '' }}

    <main>
        @yield('content')
    </main>
</body>
</html>
