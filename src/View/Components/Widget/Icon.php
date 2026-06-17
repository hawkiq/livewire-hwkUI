<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Icon extends Component
{
    public ?string $icon;
    public string $type;

    public function __construct(
        ?string $icon = null,
        string $type = 's',
    ) {
        $this->icon = $icon;
        $typeMap = [
            's' => 'fa-solid',
            'b' => 'fa-brands',
            'r' => 'fa-regular',
            'l' => 'fa-light',
            't' => 'fa-thin',
            'd' => 'fa-duotone',
        ];
        $lowerType = strtolower($type);

        if (array_key_exists($lowerType, $typeMap)) {
            $this->type = $typeMap[$lowerType];
        } elseif (in_array($lowerType, ['solid', 'brands', 'regular', 'light', 'thin', 'duotone'])) {
            $this->type = "fa-{$lowerType}";
        } else {
            $this->type = $type;
        }
    }

    public function render()
    {
        return view('hwkui::components.widget.icon');
    }
}
