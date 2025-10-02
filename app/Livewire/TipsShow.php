<?php

namespace App\Livewire;

use App\Models\Tip;
use App\Models\Reply;
use Livewire\Component;

class TipsShow extends Component
{
    protected $listeners = [
        'savedReply' => 'render({{$this -> tip }})'
    ];
    public string $reply;
    private Tip $tip;
    
    protected $rules = [
        'desc' => 'required|min:2'
    ];

    public function render(Tip $tip)
    {
        $this->tip = $tip;

        return view('livewire.tips-show', ['tip' => $tip]);
    }

    public function saveReply(Reply $reply){
        $this -> validate();

        $reply = Reply::create([
            'desc' => $this -> desc(),
            'user_id' => auth() -> user() -> id,
            'tip_id' => $this -> tip -> id
        ]);

        $reply -> save();

        $this -> dispatch('savedReply');
    }
}
