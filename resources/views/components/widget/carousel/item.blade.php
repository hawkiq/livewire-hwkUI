<div x-show="heroIndex === {{ $index }}" class="absolute inset-0" style="display: none;"
    x-transition:enter="transition ease-in-out duration-700" x-transition:enter-start="opacity-0 scale-105"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in-out duration-500"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
    {{ $slot }}
</div>
