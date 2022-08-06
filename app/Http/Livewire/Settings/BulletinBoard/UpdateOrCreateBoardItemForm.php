<?php

namespace App\Http\Livewire\Settings\BulletinBoard;

use App\Models\Board;
use Livewire\Component;

class UpdateOrCreateBoardItemForm extends Component
{
    public $user;

    public $isShowingModal = false;

    public $state = [];
    public ?Board $boardItem;

    protected $listeners = [
        'showBulletinBoardModal'
    ];
    public function render()
    {
        return view('dash.settings.bulletin-board.update-or-create-board-item-form');
    }

    public function showBulletinBoardModal($toggle, ?Board $boardItem) {
        $this->isShowingModal = $toggle;
        $this->boardItem = $boardItem;

        if ($boardItem) {
            $this->state = [

            ];
        }
    }
}
