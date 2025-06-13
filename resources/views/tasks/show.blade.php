@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header with title and back button -->
    <div class="mb-8 sm:flex sm:items-center sm:justify-between">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $task->title }}</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Created {{ $task->created_at->diffForHumans() }}</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0">
            <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                ← Back to Tasks
            </a>
        </div>
    </div>

    @if(session('success'))
        <x-ui.success-message :message="session('success')" />
    @endif

    @if(session('error'))
        <x-ui.error-message :message="session('error')" />
    @endif

    <!-- Main Content -->
    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="px-4 py-6 sm:px-6">
            <!-- Status and Labels Row -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <span @class([
                    'px-2 py-1 text-xs font-medium rounded-full',
                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $task->status === 'done',
                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' => $task->status === 'in_progress',
                    'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300' => $task->status === 'todo'
                ])>
                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                </span>

                <span @class([
                    'px-2 py-1 text-xs font-medium rounded-full',
                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $task->priority === App\Models\Task::PRIORITY_HIGH,
                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $task->priority === App\Models\Task::PRIORITY_MEDIUM,
                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $task->priority === App\Models\Task::PRIORITY_LOW
                ])>
                    {{ $task->getPriorityLabel() }} Priority
                </span>

                @if($task->due_date)
                    <span @class([
                        'px-2 py-1 text-xs font-medium rounded-full',
                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $task->due_date->isPast() && $task->status !== 'done',
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $task->due_date->isToday(),
                        'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300' => $task->due_date->isFuture()
                    ])>
                        Due {{ $task->due_date->format('M j, Y') }}
                    </span>
                @endif

                @if($task->estimated_hours)
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                        {{ $task->estimated_hours }} hours estimated
                    </span>
                @endif
            </div>

            <!-- Description -->
            @if($task->description)
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h3>
                <p class="mt-2 text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $task->description }}</p>
            </div>
            @endif

            <!-- Project Link -->
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Project</h3>
                <p class="mt-2">
                    <a href="{{ route('projects.show', $task->project) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                        {{ $task->project->title }}
                    </a>
                </p>
            </div>

            <!-- Labels -->
            @if($task->labels && count($task->labels) > 0)
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Labels</h3>
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($task->labels as $label)
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300">
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Group -->
            @if($task->group)
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Group</h3>
                <p class="mt-2 text-gray-900 dark:text-gray-100">{{ $task->group }}</p>
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4 sm:px-6 flex justify-end space-x-3">
            <a href="{{ route('tasks.edit', $task) }}" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Edit Task
            </a>
            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
