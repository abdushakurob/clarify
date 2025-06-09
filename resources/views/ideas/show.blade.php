@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header with title and back button -->
    <div class="mb-8 sm:flex sm:items-center sm:justify-between">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">{{ $idea->title }}</h1>
            <p class="mt-2 text-sm text-gray-700">Created {{ $idea->created_at->diffForHumans() }}</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0">
            <a href="{{ route('ideas.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                ← Back to Ideas
            </a>
        </div>
    </div>

    <!-- Main content -->
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <!-- Basic Information -->
        <div class="px-4 py-5 sm:p-6">
            @if($idea->notes)
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Notes</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $idea->notes }}</p>
            </div>
            @endif

            <!-- Clarification Fields -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Idea Clarification</h3>
                
                @if($idea->problem)
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Problem</h4>
                    <p class="text-gray-900">{{ $idea->problem }}</p>
                </div>
                @endif

                @if($idea->audience)
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Target Audience</h4>
                    <p class="text-gray-900">{{ $idea->audience }}</p>
                </div>
                @endif

                @if($idea->possible_solution)
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Possible Solution</h4>
                    <p class="text-gray-900">{{ $idea->possible_solution }}</p>
                </div>
                @endif

                <!-- Ready Status -->
                <div class="mt-6 flex items-center">
                    @if($idea->is_ready)
                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            Ready for Project
                        </span>
                    @else
                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-sm font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                            In Progress
                        </span>
                    @endif
                </div>
            </div>

            <!-- Tags -->
            @if($idea->tags->count() > 0)
            <div class="border-t border-gray-200 pt-6 mt-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($idea->tags as $tag)
                        <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
