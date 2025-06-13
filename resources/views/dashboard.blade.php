@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-8 md:px-10 md:py-12 md:flex md:items-center md:justify-between">
                <div class="max-w-2xl">
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="mt-2 text-indigo-100">Here's your productivity overview for today. Focus on what matters most.</p>
                </div>
                <div class="mt-6 md:mt-0 flex space-x-3">
                    <a href="{{ route('ideas.create') }}" class="bg-white text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-md text-sm font-medium shadow-sm">
                        Capture Idea
                    </a>
                    <a href="{{ route('tasks.create') }}" class="bg-indigo-700 text-white hover:bg-indigo-800 px-4 py-2 rounded-md text-sm font-medium shadow-sm">
                        Add Task
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg group hover:shadow-md transition-all">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Active Projects</h3>
                            <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $activeProjects }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('projects.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">View projects →</a>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg group hover:shadow-md transition-all">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tasks Due Today</h3>
                            <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $tasksDueToday }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">View tasks →</a>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg group hover:shadow-md transition-all">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Ideas</h3>
                            <p class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $recentIdeas }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('ideas.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">View ideas →</a>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg group hover:shadow-md transition-all">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Completed Tasks</h3>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $completedTasks }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('tasks.index') }}?filter=completed" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">View completed →</a>
                    </div>
                </div>
            </div>
        </div>

            <!-- Recent Activity and Tasks -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tasks Due Soon -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tasks Due Soon</h3>
                            <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View All</a>
                        </div>
                        @if($upcomingTasks->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">No upcoming tasks</p>
                        @else
                            <div class="space-y-3">
                                @foreach($upcomingTasks as $task)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Due {{ $task->due_date->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full {{ 
                                            $task->status === 'done' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                            ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                            'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300') 
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Projects -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Projects</h3>
                            <a href="{{ route('projects.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View All</a>
                        </div>
                        @if($recentProjects->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">No recent projects</p>
                        @else
                            <div class="space-y-3">
                                @foreach($recentProjects as $project)
                                    <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                                    <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                        {{ $project->title }}
                                                    </a>
                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $project->tasks_count }} tasks
                                                </p>
                                            </div>
                                            <span class="px-2 py-1 text-xs rounded-full {{ 
                                                $project->status === 'done' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                                ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                                'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300') 
                                            }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('ideas.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Capture New Idea
                        </a>
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Create Project
                        </a>
                        <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add Task
                        </a>
                        <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Calendar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
