<?php

namespace App\Http\Livewire\BulletinBoard\BulletinCards;
use App\Models\Board;
use Livewire\Component;


class Cards extends Component
{
    public function render()
    {
        $boards = Board::paginate(12);
        return view('dash.bulletin-board.index', compact('boards'));

    }
    public function cardItem($HouseId){
        $board = Board::where('HouseId', $HouseId)->first();
        return view('dash.bulletin-board.board-item', compact('board'));
    }
}
