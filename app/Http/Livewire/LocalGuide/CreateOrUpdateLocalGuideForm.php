<?php

namespace App\Http\Livewire\LocalGuide;

use App\Models\LocalGuide;
use App\Models\LocalGuideCategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateLocalGuideForm extends Component
{
    use WithFileUploads;

    public $isShowingModal = false;

    public $state = [];

    public $file;

    public ?LocalGuide $localGuide;

    protected $listeners = [
        'showLocalGuideCUModal',
    ];

    public function render()
    {
        $localGuideCategories = LocalGuideCategory::all();

        return view('dash.local-guide.create-or-update-local-guide-form',compact('localGuideCategories')) ;
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showLocalGuideCUModal($toggle, ?LocalGuide $localGuide)
    {
        $this->emitSelf('toggle', $toggle);
        $this->localGuide = $localGuide;
        $this->reset(['state', 'file']);

        if ($localGuide) {
            $this->state = \Arr::only($localGuide->toArray(), ['title','name','content','image','status']);
        }
    }

    public function saveLocalGuideCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }else{
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'title' => 'required|string|max:100',
        ])->validateWithBag('saveLocalGuideCU');

        $this->localGuide->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'name' => $inputs['name'],
            'title' => $inputs['title'],
            'status' => $inputs['status'] ?? 0,
            'content' => $inputs['content'],
        ])->save();

        $this->localGuide->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->emit('user-cu-successfully');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->localGuide->id) {
            $this->localGuide->deleteFile();
            $this->emit('user-cu-successfully');
        }
    }

}
