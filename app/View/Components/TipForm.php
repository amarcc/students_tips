<?php

namespace App\View\Components;

use App\Models\Program;
use App\Models\Tip;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TipForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $formType,
        public Program $program,
        public ?Tip $tip
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tip-form');
    }
}
