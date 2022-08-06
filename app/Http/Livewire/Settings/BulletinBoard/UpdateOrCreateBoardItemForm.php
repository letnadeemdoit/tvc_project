<?php

namespace App\Http\Livewire\Settings\BulletinBoard;

use App\Models\Board;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateOrCreateBoardItemForm extends Component
{
    use WithFileUploads;

    public $user;

    public $isShowingModal = false;

    public $file;

    public $OldImage;

    public $updateMode = false;


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
        $this->emitSelf('toggle',$toggle);
        $this->boardItem = $boardItem;

        if ($boardItem) {
            $this->OldImage = $boardItem->image;
            $this->state = \Arr::only($boardItem->toArray(), ['title', 'image', 'Board']);

        }
    }

    public function createBulletinBoard(){

        $inputs = $this->state;
        Validator::make($this->state,[
            'title' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'Board' => 'required',
        ])->validate();
        if ($this->file)  {
            $inputs['image']  = $this->file;
            $imageName = $inputs['image']->store("BulletinBoard",'public');
        }
        Board::create([
            'HouseId' => \Auth::user()->HouseId,
            'title' => $inputs['title'],
            'Board' => $inputs['Board'],
            'image' => $imageName ?? null,
            'Audit_user_name' => \Auth::user()->user_name,
            'Audit_Role' => \Auth::user()->role,
            'Audit_FirstName' => \Auth::user()->first_name,
            'Audit_LastName' => \Auth::user()->last_name,
            'Audit_Email' => \Auth::user()->email,

        ]);

        $this->emitSelf('toggle',false);

        $this->emit('refreshBulletinBoard');

        session()->flash('success', 'Board Details Created Successfully.');

    }


    public function updateBulletinBoard(){

        $inputs = $this->state;


        Validator::make($this->state,[
            'title' => 'nullable',
            'image' => 'nullable',
            'Board' => 'required',
        ])->validate();

        if ($this->file)  {
            $inputs['image']  = $this->file;
            $imageName = $inputs['image']->store("BulletinBoard",'public');
        }

        $board = $this->boardItem ?? null;

        $board->fill([

            'HouseId' => \Auth::user()->HouseId,
            'title' => $inputs['title'],
            'Board' => $inputs['Board'],
            'image' => $imageName ?? null,
            'Audit_user_name' => \Auth::user()->user_name,
            'Audit_Role' => \Auth::user()->role,
            'Audit_FirstName' => \Auth::user()->first_name,
            'Audit_LastName' => \Auth::user()->last_name,
            'Audit_Email' => \Auth::user()->email,

        ])->save();

        $this->emitSelf('toggle',false);


        $this->emit('refreshBulletinBoard');

        session()->flash('success', 'Board Details updated Successfully.');

    }






}
