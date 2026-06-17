@if ($icon)
    <i {{ $attributes->merge(['class' => "{$type} fa-{$icon}"]) }}></i>
@endif