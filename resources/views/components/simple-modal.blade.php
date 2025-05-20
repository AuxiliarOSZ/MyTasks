@props(['id', 'maxWidth' => '2xl', 'show' => false])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div
    x-data="{ show: @js($show) }"
    x-show="show"
    x-on:close.window="show = false"
    x-on:keydown.escape.window="show = false"
    id="{{ $id }}"
    class="fixed inset-0 flex items-center justify-center z-50 px-4 py-6"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 bg-gray-500 opacity-75"></div>

    <div
        x-show="show"
        class="bg-white rounded-lg shadow-xl transform transition-all w-full {{ $maxWidthClass }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>
