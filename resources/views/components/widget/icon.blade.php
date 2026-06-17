@if ($name)
    <i {{ $attributes->merge(['class' => "{$type} fa-{$name}"]) }}></i>
@endif