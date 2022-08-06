<?php

namespace App\Http\Livewire\Settings\BulletinBoard;

use App\Models\Board;
use Livewire\Component;

class BoardItemsList extends Component
{

    public $searchQuery = '';

    protected $listeners = [
        'refreshBulletinBoard' => '$refresh'
    ];

    public function render()
    {
        $data = Board::paginate(18);
        return view('dash.settings.bulletin-board.board-items-list',compact('data'));
    }


    public function destroy($id)
    {
        $board = Board::where('id', $id);

        if ($board) {

            $this->emit('hideModal');

            session()->flash('success', 'Board Item  Deleted successfully...');

            $board->delete();

        }
    }
}
