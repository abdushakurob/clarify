@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $project->title }}</h1>
                <span class="ml-3 px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($project->status == 'todo') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                    @elseif($project->status == 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                    @elseif($project->status == 'done') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                    @endif
                ">
                    @if($project->status == 'todo') To Do
                    @elseif($project->status == 'in_progress') In Progress
                    @elseif($project->status == 'done') Done
                    @endif
                </span>
            </div>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ $project->description }}</p>
            
            @if($project->idea)
            <div class="mt-2">
                <span class="text-sm text-gray-500 dark:text-gray-400">Based on idea: </span>
                <a href="{{ route('ideas.show', $project->idea) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                    {{ $project->idea->title }}
                </a>
            </div>
            @endif

            @if($project->tags->isNotEmpty())
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach($project->tags as $tag)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                    {{ $tag->name }}
                </span>
                @endforeach
            </div>
            @endif
        </div>
        
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-medium text-xs text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-medium text-xs text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Task
            </a>
        </div>
    </div>

    <!-- Project Features -->
    @if(is_array($project->features) && count($project->features) > 0)
    <div class="mt-10">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Project Features</h2>
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($project->features as $feature)
                <li>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 truncate">{{ $feature }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Project Tasks -->
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tasks</h2>
            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                + Add New Task
            </a>
        </div>
        
        @if($project->tasks->isEmpty())
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md p-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">No tasks created for this project yet.</p>
            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="mt-2 inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                Create your first task
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
        @else
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($project->tasks as $task)
                <li>
                    <a href="{{ route('tasks.show', $task) }}" class="block hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 mr-2">
                                        @if($task->status == 'todo')
                                            <span class="h-5 w-5 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center"></span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="h-5 w-5 rounded-full bg-blue-200 dark:bg-blue-900 flex items-center justify-center"></span>
                                        @elseif($task->status == 'done')
                                            <span class="h-5 w-5 rounded-full bg-green-200 dark:bg-green-900 flex items-center justify-center">
                                                <svg class="h-3 w-3 text-green-600 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 {{ $task->status == 'done' ? 'line-through' : '' }}">
                                        {{ $task->title }}
                                    </p>
                                </div>
                                <div class="flex items-center">
                                    @if($task->due_date)
                                    <div class="mr-4">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Due: {{ $task->due_date->format('M j, Y') }}
                                        </p>
                                    </div>
                                    @endif
                                    <div>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($task->priority == 0) bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                            @elseif($task->priority == 1) bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                            @elseif($task->priority == 2) bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                            @endif">
                                            {{ $task->getPriorityLabel() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection