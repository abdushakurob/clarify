@extends('layouts.app')

@section('content')
<!-- Hero section -->
<div class="relative isolate overflow-hidden bg-white dark:bg-gray-900">
    <!-- Background gradient effect -->
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:py-32">
            <!-- Small announcement banner -->
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 dark:text-gray-300 ring-1 ring-gray-900/10 dark:ring-gray-100/10 hover:ring-gray-900/20 dark:hover:ring-gray-100/20">
                    Discover a new way to organize your ideas. <a href="{{ route('ideas.index') }}" class="font-semibold text-indigo-600 dark:text-indigo-400"><span class="absolute inset-0" aria-hidden="true"></span>See how <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>

            <!-- Main hero content -->
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-6xl">
                    <span class="block text-indigo-600 dark:text-indigo-400">Clarify</span>
                    <span class="block">Your Ideas & Projects</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Turn your scattered thoughts into organized projects. Clarify helps you capture ideas when they strike and develop them into actionable plans with clear tasks and milestones.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    @auth
                        <a href="{{ route('ideas.create') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Capture New Idea
                        </a>
                        <a href="{{ route('dashboard') }}" class="rounded-md bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Go to Dashboard
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get Started
                            </a>
                        @endif
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="rounded-md bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                Log in
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Feature section -->
        <div class="mx-auto mt-8 max-w-7xl px-6 sm:mt-16 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-indigo-400">Manage Better</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl">Everything you need to organize your thoughts</p>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Clarify provides a structured approach to turn your ideas into reality.
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            Capture Ideas
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Quickly capture your ideas when inspiration strikes. Add notes, tags, and organize them your way.</p>
                        </dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                </svg>
                            </div>
                            Clarify & Refine
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Develop and refine your ideas through structured fields and prompts that help bring clarity to your thoughts.</p>
                        </dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                </svg>
                            </div>
                            Transform Into Projects
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Turn your refined ideas into actionable projects with clear goals, tasks, and timelines.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
