<?php

namespace App\View\Components;

use App\Models\Faculty;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FacultyForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $formType,
        public ?Faculty $faculty
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.faculty-form');
    }
}
