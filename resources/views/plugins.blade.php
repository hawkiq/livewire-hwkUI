@php
    use Hawkiq\Hwkui\Helpers\PluginLoader;
    $requiredPlugins = PluginLoader::getRequired();
@endphp

@foreach (config('hwkui.plugins') as $pluginName => $plugin)
    @if (in_array($pluginName, $requiredPlugins))
        @foreach ($plugin['files'] as $file)
            @php
                if (!empty($file['asset'])) {
                    $file['location'] = asset($file['location']);
                }
            @endphp

            @if ($file['type'] === $type && $type === 'css')
                <link rel="stylesheet" href="{{ $file['location'] }}">
            @elseif ($file['type'] === $type && $type === 'js')
                <script src="{{ $file['location'] }}" @if (!empty($file['defer'])) defer @endif></script>
            @endif
        @endforeach
    @endif
@endforeach
