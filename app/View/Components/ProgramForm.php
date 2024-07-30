<?php

namespace App\View\Components;

use App\Models\Faculty;
use App\Models\Program;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgramForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $formType,
        public Faculty $faculty,
        public ?Program $program
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.program-form');
    }
}
