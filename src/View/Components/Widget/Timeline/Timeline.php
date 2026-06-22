<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Timeline;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Hawkiq\Hwkui\Support\TimelineContext;


class Timeline extends Component
{
    public ?Collection $items;
    public $paginator = null;

    public function __construct(
        $items = null,
        public ?string $titleColumn = null,
        public ?string $bodyColumn = null,
        public string $direction = 'vertical',
        public string $color = 'primary',
        public string $length = 'short',
    ) {
        $this->items = $items ? collect($items) : collect();
    }

    public function hasItemsMode(): bool
    {
        return filled($this->items);
    }

    public function hasPagination(): bool
    {
        return $this->paginator !== null;
    }

    public function render(): View|Closure|string
    {
        TimelineContext::$direction = $this->direction;
        TimelineContext::$color = $this->color;
        TimelineContext::$length = $this->length;
        return view('hwkui::components.widget.timeline.timeline');
    }
}
