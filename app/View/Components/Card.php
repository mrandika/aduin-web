<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{

    public $header, $footer;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header = null, $footer = null)
    {
        $this->header = $header;
        $this->footer = $footer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
