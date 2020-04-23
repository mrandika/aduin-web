<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListReport extends Component
{
    public $contents;
    public $state;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($contents, $state)
    {
        $this->contents = $contents;
        $this->state = $state;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.list-report');
    }
}
