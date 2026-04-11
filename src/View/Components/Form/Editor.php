<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\View\Component;


class Editor extends Component
{
    public $id;
    public $theme;
    public $toolbar;

    public function __construct($id = 'editor', $theme = 'snow', $toolbar = null)
    {
        $this->id = $id;
        $this->theme = $theme ?? config('hwkui.editor.defaultTheme', 'snow');
        $this->toolbar = $toolbar;

    }

    public function render()
    {
        return view('hwkui::components.form.editor');
    }
}
