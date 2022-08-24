<?php

namespace App\Http\Livewire\BulletinBoard;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Board;
use Livewire\Component;

class BoardItemCard extends Component
{
    public Board $dt;

    use Toastr;


    public function render()
    {
        return view('bulletin-board.board-item-card');
    }
}
