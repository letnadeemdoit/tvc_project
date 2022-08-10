<?php

namespace App\Http\Livewire\Settings\BulletinBoard;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateBoardItemForm extends Component
{
    use WithFileUploads;

    public $isShowingModal = false;

    public $state = [];

    public $file;

    public ?Board $boardItem;

    protected $listeners = [
        'showBulletinBoardCUModal',
    ];

    public function render()
    {
        return view('dash.settings.bulletin-board.create-or-update-board-item-form');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showBulletinBoardCUModal($toggle, ?Board $boardItem)
    {
        $this->emitSelf('toggle', $toggle);
        $this->boardItem = $boardItem;

        if ($boardItem) {
            $this->state = \Arr::only($boardItem->toArray(), ['title', 'image', 'Board']);
        }
    }

    public function saveBulletinBoardCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }

        Validator::make($inputs, [
            'title' => 'required|string|max:100',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'Board' => 'required',
        ])->validateWithBag('saveBulletinBoardCU');

        $this->boardItem->fill([
            'HouseId' => auth()->user()->HouseId,
            'title' => $inputs['title'] ?? '',
            'Board' => $inputs['Board'],
        ])->save();

        $this->boardItem->updateFile($this->file);

        $this->emitSelf('toggle', false);
        $this->emit('user-cu-successfully');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

}
