@props([
    'texto',
    'textColor'=>'text-tBlack',
    'display',
])

<div @keydown.escape.window="open = false" class="relative" x-data="{ open: false }">
    <button @click="open = !open"
        class="flex flex-row {{$textColor}} items-center px-2 w-full py-2 mt-2 text-sm 
        font-semibold text-left rounded-lg 
        md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 
        focus:outline-none focus:shadow-outline">
        <span>{{ $texto }}</span>
        <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>

    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="{{ $display ?? '' }} pt-1 right-0 pl-2 w-full origin-top-right">
        <div class="px-2 pt-2 pb-2 bg-white rounded-md shadow-lg">
            <div class="grid grid-cols-1 gap-1">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

