<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\View\Component;

class PasswordStrength extends Component
{
    public string $name;
    public bool $checklist;
    public array $rules;

    public function __construct(string $name = 'password', bool $checklist = true, $rules = [
        'length' => 8,
        'uppercase' => true,
        'lowercase' => true,
        'number' => true,
        'symbol' => true,
    ])
    {
        $this->name = $name;
        $this->rules = $rules;
        $this->checklist = filter_var($checklist, FILTER_VALIDATE_BOOLEAN);
    }

    public function render()
    {
        return view('hwkui::components.form.password-strength');
    }
}
