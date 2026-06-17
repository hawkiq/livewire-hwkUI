@props([])

@php
    $vertical = $direction === 'vertical';
@endphp

<div
    {{
        $attributes->class([
            'hwkui-timeline flex w-full text-sm',
            'flex-col gap-2' => $vertical,
            'flex-row items-start justify-start gap-4 overflow-x-auto py-2' => !$vertical,
        ])
    }}
>

    @if($hasItemsMode())
        @foreach($items as $item)
        

            <x-hwkui-timeline.item>

                <x-hwkui-timeline.indicator
                    :state="$loop->last ? 'last' : 'completed'"
                    :color="$color"
                >
                <x-hwkui-icon type="r" name="circle" />
            </x-hwkui-timeline.indicator>

                <x-hwkui-timeline.content>

                    <x-hwkui-timeline.title>
                        {{ data_get($item, $titleColumn) }}
                    </x-hwkui-timeline.title>

                    @if($bodyColumn && filled(data_get($item, $bodyColumn)))

                        <x-hwkui-timeline.body>
                            {{ data_get($item, $bodyColumn) }}
                        </x-hwkui-timeline.body>

                    @endif

                </x-hwkui-timeline.content>

            </x-hwkui-timeline.item>

        @endforeach

    @else

        {{ $slot }}

    @endif

</div>