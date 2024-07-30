<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LikeButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?int $size = 6,
        public ?string $firstColor = 'black'
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.like-button');
    }
}
