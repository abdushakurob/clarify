@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8 sm:flex sm:items-center sm:justify-between">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Edit Task</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0">
            <a href="{{ route('tasks.show', $task) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                ← Back to Task
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Task Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $task->description) }}</textarea>
                </div>

                <!-- Project -->
                <div>
                    <label for="project_id" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Project</label>
                    <select name="project_id" id="project_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select a project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" 
                                {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <!-- Priority -->
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Priority</label>
                    <select name="priority" id="priority" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach(App\Models\Task::priorities() as $value => $label)
                            <option value="{{ $value }}" 
                                {{ old('priority', $task->priority) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Due Date</label>
                    <input type="date" name="due_date" id="due_date" 
                        value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Estimated Hours -->
                <div>
                    <label for="estimated_hours" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Estimated Hours</label>
                    <input type="number" name="estimated_hours" id="estimated_hours" 
                        value="{{ old('estimated_hours', $task->estimated_hours) }}" min="0"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Group -->
                <div>
                    <label for="group" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Group</label>
                    <input type="text" name="group" id="group" value="{{ old('group', $task->group) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Labels -->
                <div>
                    <label for="labels" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Labels</label>
                    <input type="text" name="labels" id="labels" 
                        value="{{ old('labels', is_array($task->labels) ? implode(', ', $task->labels) : '') }}"
                        placeholder="Enter labels separated by commas"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Separate labels with commas</p>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 flex justify-end space-x-3">
                <a href="{{ route('tasks.show', $task) }}"
                    class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-800">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Update Task
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
