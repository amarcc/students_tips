<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $value = '',
        public ?string $type = 'text',
        public string $name = '',
        public ?string $placeholder = '',
        public ?int $rows = 5,
        public ?string $form = '',
        public ?bool $btn = true,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
