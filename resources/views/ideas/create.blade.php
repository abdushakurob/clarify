@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Add New Idea</h2>
        </div>
    </div>

    <form method="POST" action="{{ route('ideas.store') }}" class="mt-8 space-y-6">
        @csrf
        <div class="space-y-6 bg-white px-6 py-6 sm:rounded-lg shadow">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Basic Information</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="What's your idea?">
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium leading-6 text-gray-900">Notes</label>
                        <div class="mt-2">
                            <textarea id="notes" name="notes" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Add any additional thoughts..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Idea Clarification -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Idea Clarification</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="problem" class="block text-sm font-medium leading-6 text-gray-900">Problem</label>
                        <div class="mt-2">
                            <textarea id="problem" name="problem" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="What problem does this idea solve?"></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="audience" class="block text-sm font-medium leading-6 text-gray-900">Target Audience</label>
                        <div class="mt-2">
                            <textarea id="audience" name="audience" rows="2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Who is this idea for?"></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="possible_solution" class="block text-sm font-medium leading-6 text-gray-900">Possible Solution</label>
                        <div class="mt-2">
                            <textarea id="possible_solution" name="possible_solution" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="How might this idea be implemented?"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_ready" name="is_ready" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="is_ready" class="ml-2 block text-sm text-gray-900">Mark as ready for project</label>
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tags</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="tags" class="block text-sm font-medium leading-6 text-gray-900">Select Existing Tags</label>
                        <div class="mt-2">
                            <select id="tags" name="tags[]" multiple class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Hold Ctrl (Windows) or Cmd (Mac) to select multiple tags.</p>
                    </div>

                    <div>
                        <label for="new_tags" class="block text-sm font-medium leading-6 text-gray-900">Add New Tags</label>
                        <div class="mt-2">
                            <input type="text" name="new_tags" id="new_tags" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="e.g. productivity, inspiration">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Separate multiple tags with commas.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-x-6">
            <a href="{{ route('ideas.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save Idea
            </button>
        </div>
    </form>
</div>
@endsection
