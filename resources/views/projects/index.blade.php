@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Projects') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Manage your ongoing and completed projects.</p>
        </div>
        <div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('New Project') }}
            </a>
        </div>
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($projects->isEmpty())
                        <div class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">No projects yet</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first project</p>
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create your first project
                            </a>
                        </div>
                    @else
                        <!-- Filter and search options -->
                        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Filter:</span>
                                <select id="status-filter" class="text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="all">All Projects</option>
                                    <option value="todo">To Do</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="relative">
                                <input type="text" id="project-search" placeholder="Search projects..." class="pl-10 pr-4 py-2 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
                            @foreach($projects as $project)
                                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 flex flex-col">
                                    <div class="p-5 flex-grow">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-lg font-semibold">
                                                <a href="{{ route('projects.show', $project) }}" class="text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">
                                                    {{ $project->title }}
                                                </a>
                                            </h3>
                                            <span class="px-2 py-1 text-xs rounded-full {{ $project->status === 'done' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300') }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </div>
                                        
                                        @if($project->description)
                                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                                {{ Str::limit($project->description, 100) }}
                                            </p>
                                        @endif

                                        <!-- Tags display -->
                                        @if(isset($project->tags) && count($project->tags) > 0)
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                @foreach($project->tags as $tag)
                                                    <span class="inline-flex items-center bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs px-2.5 py-0.5 rounded-full">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        @if($project->features)
                                            <div class="mt-4">
                                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Features ({{ count($project->features) }})</h4>
                                                <div class="mt-2 space-y-1">
                                                    @foreach(array_slice($project->features, 0, 3) as $feature)
                                                        <div class="text-xs text-gray-600 dark:text-gray-300">• {{ $feature['title'] }}</div>
                                                    @endforeach
                                                    @if(count($project->features) > 3)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">+ {{ count($project->features) - 3 }} more</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Card footer with actions -->
                                    <div class="border-t border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 p-3 rounded-b-lg">
                                        <div class="flex justify-between items-center">
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                Created {{ $project->created_at->diffForHumans() }}
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('projects.edit', $project) }}" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination if needed -->
                        @if(method_exists($projects, 'links') && $projects->hasPages())
                            <div class="mt-6">
                                {{ $projects->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.getElementById('status-filter');
        const searchInput = document.getElementById('project-search');
        const projects = document.querySelectorAll('.grid > div');
        
        if (statusFilter && searchInput && projects.length > 0) {
            // Filter by status
            statusFilter.addEventListener('change', filterProjects);
            
            // Search by title
            searchInput.addEventListener('input', filterProjects);
            
            function filterProjects() {
                const status = statusFilter.value;
                const searchTerm = searchInput.value.toLowerCase();
                
                projects.forEach(project => {
                    const projectStatus = project.querySelector('.rounded-full').textContent.trim().toLowerCase();
                    const projectTitle = project.querySelector('h3 a').textContent.trim().toLowerCase();
                    
                    const statusMatch = status === 'all' || projectStatus.includes(status.replace('_', ' '));
                    const searchMatch = projectTitle.includes(searchTerm);
                    
                    if (statusMatch && searchMatch) {
                        project.classList.remove('hidden');
                    } else {
                        project.classList.add('hidden');
                    }
                });
            }
        }
    });
</script>
@endpush
@endsection