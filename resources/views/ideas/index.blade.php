@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold leading-6 text-gray-900">Ideas Inbox</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all your captured ideas and thoughts.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('ideas.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add New Idea
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 mt-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    @if($ideas->count() > 0)
                        <div class="min-w-full divide-y divide-gray-300">
                            @foreach($ideas as $idea)
                                <div class="bg-white px-4 py-5 sm:px-6 hover:bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                    <a href="{{ route('ideas.show', $idea->id) }}" class="hover:text-indigo-600">
                                                        {{ $idea->title }}
                                                    </a>
                                                </h3>
                                                @if($idea->is_ready)
                                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                        Ready
                                                    </span>
                                                @endif
                                            </div>
                                            @if($idea->notes)
                                                <p class="mt-1 text-sm text-gray-600">{{ Str::limit($idea->notes, 100) }}</p>
                                            @endif
                                            @if($idea->problem)
                                                <p class="mt-1 text-sm text-gray-500">
                                                    <span class="font-medium">Problem:</span> 
                                                    {{ Str::limit($idea->problem, 100) }}
                                                </p>
                                            @endif
                                            <div class="mt-2 flex flex-wrap gap-2">
                                                @foreach($idea->tags as $tag)
                                                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="ml-4 flex flex-col items-end gap-2">
                                            <span class="text-sm text-gray-500">{{ $idea->created_at->diffForHumans() }}</span>
                                            <a href="{{ route('ideas.show', $idea->id) }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                                                View Details →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 px-6">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No ideas yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new idea.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
