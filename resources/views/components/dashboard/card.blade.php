@props(['title', 'value', 'icon', 'color'])

@php
    $colorBase = explode('-', $color)[1] ?? 'gray';
    $shadowGlow = match ($colorBase) {
        'blue' => 'hover:shadow-glow-blue',
        'green' => 'hover:shadow-glow-green',
        'cyan' => 'hover:shadow-glow-cyan',
        default => '',
    };
@endphp

<div class="bg-white p-4 rounded-lg shadow-md border border-transparent flex items-center justify-between transition-transform transform hover:scale-105 {{ $shadowGlow }} hover:animate-pulse-glow">
    <div>
        <div class="text-sm font-semibold {{ $color }} transition-colors duration-300">
            {{ $title }}
        </div>
        <div class="text-lg font-bold">{{ $value }}</div>
    </div>
    <div class="text-3xl {{ $color }}">
        {{ $icon }}
    </div>
</div>
