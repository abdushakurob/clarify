@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold leading-6 text-gray-900 dark:text-gray-100">Tasks</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">A list of all your tasks across all projects.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('tasks.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add New Task
            </a>
        </div>
    </div>

    @if(session('success'))
        <x-ui.success-message :message="session('success')" />
    @endif

    @if(session('error'))
        <x-ui.error-message :message="session('error')" />
    @endif

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    @if($tasks->count() > 0)
                        <div class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                            <div class="bg-gray-50 dark:bg-gray-800">
                                <div class="grid grid-cols-12 px-4 py-3.5 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    <div class="col-span-4">Task</div>
                                    <div class="col-span-2">Project</div>
                                    <div class="col-span-2">Due Date</div>
                                    <div class="col-span-2">Priority</div>
                                    <div class="col-span-2">Status</div>
                                </div>
                            </div>
                            <div class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                                @foreach($tasks as $task)
                                    <div class="grid grid-cols-12 px-4 py-4 text-sm hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <div class="col-span-4">
                                            <a href="{{ route('tasks.show', $task) }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                                                {{ $task->title }}
                                            </a>
                                            @if($task->description)
                                                <p class="mt-1 truncate text-gray-500 dark:text-gray-400">
                                                    {{ Str::limit($task->description, 60) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-span-2 text-gray-500 dark:text-gray-400">
                                            @if($task->project)
                                                <a href="{{ route('projects.show', $task->project) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                    {{ $task->project->title }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div class="col-span-2 text-gray-500 dark:text-gray-400">
                                            @if($task->due_date)
                                                <span @class([
                                                    'px-2 py-1 text-xs rounded-full',
                                                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $task->due_date->isPast() && $task->status !== 'done',
                                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $task->due_date->isToday(),
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300' => $task->due_date->isFuture()
                                                ])>
                                                    {{ $task->due_date->format('M j, Y') }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div class="col-span-2">
                                            <span @class([
                                                'px-2 py-1 text-xs rounded-full',
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $task->priority === App\Models\Task::PRIORITY_HIGH,
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $task->priority === App\Models\Task::PRIORITY_MEDIUM,
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $task->priority === App\Models\Task::PRIORITY_LOW
                                            ])>
                                                {{ $task->getPriorityLabel() }}
                                            </span>
                                        </div>
                                        <div class="col-span-2">
                                            <span @class([
                                                'px-2 py-1 text-xs rounded-full',
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $task->status === 'done',
                                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' => $task->status === 'in_progress',
                                                'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300' => $task->status === 'todo'
                                            ])>
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                            {{ $tasks->links() }}
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">No tasks found.</div>
                            <a href="{{ route('tasks.create') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                Create your first task
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
