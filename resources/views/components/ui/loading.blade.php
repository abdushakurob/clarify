@props([
    'show' => false,
    'size' => 'md', // sm, md, lg  
    'description' => 'Loading...'
])

@php
    $sizes = [
        'sm' => 'h-8 w-8',
        'md' => 'h-12 w-12',
        'lg' => 'h-16 w-16'
    ];
    $spinnerSize = $sizes[$size] ?? $sizes['md'];
@endphp

<div x-data="{ show: @js($show) }" 
     x-show="show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-8 flex flex-col items-center shadow-xl">
        <div class="animate-spin rounded-full {{ $spinnerSize }} border-4 border-indigo-600 dark:border-indigo-400 border-t-transparent mb-4"></div>
        @if($slot->isEmpty())
            <p class="text-gray-700 dark:text-gray-300">{{ $description }}</p>
        @else
            <div class="text-gray-700 dark:text-gray-300">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>