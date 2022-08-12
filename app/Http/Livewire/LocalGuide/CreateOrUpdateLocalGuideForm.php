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
            $this->state = \Arr::only($localGuide->toArray(), ['local_guide_category_id','title','description','image','address','datetime']);
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
            'local_guide_category_id' => 'required',
        ])->validateWithBag('saveLocalGuideCU');


        $this->localGuide->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'local_guide_category_id' => $inputs['local_guide_category_id'] ?? null,
            'title' => $inputs['title'],
            'description' => $inputs['description'] ?? null,
            'address' => $inputs['address'] ?? null,
            'datetime' => $inputs['datetime'] ?? null,
        ])->save();

        $this->localGuide->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->emit('local-guide-cu-successfully');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->localGuide->id) {
            $this->localGuide->deleteFile();
            $this->emit('local-guide-cu-successfully');
        }
    }

}
