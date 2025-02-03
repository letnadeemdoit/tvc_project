<?php

namespace App\Http\Livewire\Settings\LocalGuide;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Category;
use App\Models\LocalGuide;
use App\Models\LocalGuideCategory;
use App\Models\User;
use App\Notifications\LocalGuideNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateLocalGuideForm extends Component
{
    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;

    public $state = [];

    public $siteUrl;


    public $user;

    public $file;

    public $isCreating = false;

    public ?LocalGuide $localGuide;

    protected $listeners = [
        'showLocalGuideCUModal',
    ];

    public function render()
    {

        $localGuideCategories = Category::where('type', 'local-guide')
           ->where(function ($query){
               $query->where('house_id', $this->user->HouseId)
                   ->orWhere('house_id', null);
           })
            ->get();

        return view('dash.settings.local-guide.create-or-update-local-guide-form',compact('localGuideCategories')) ;
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

        if ($localGuide->id) {
            $this->isCreating = false;
            $this->state = \Arr::only($localGuide->toArray(), ['category_id','title','description','image','address','datetime']);
        }else{
            $this->isCreating = true;
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
            'category_id' => 'required',
            'address' => 'nullable|max:255',
            'description' => 'nullable|max:4000000000',
        ])->validateWithBag('saveLocalGuideCU');

        if ($this->isCreating){
            $this->localGuide->user_id = auth()->user()->user_id;
            $this->localGuide->house_id = auth()->user()->HouseId;
        }

        $this->localGuide->fill([
            'category_id' => $inputs['category_id'] ?? null,
            'title' => $inputs['title'],
            'description' => $inputs['description'] ?? null,
            'address' => $inputs['address'] ?? null,
            'datetime' => $inputs['datetime'] ?? null,
        ])->save();

        $this->localGuide->updateFile($this->file);

        try {
            $slug = $this->localGuide->id;
            $this->siteUrl = route('guest.local-guide.show', $slug);


            $items = $this->localGuide;
            $createdHouseName = $this->user->house->HouseName;
            $ccList = [];
            if ($this->user && primary_user()->email !== $this->user->email) {
                $ccList[] = $this->user->email;
            }

            if (!is_null($this->user->house->local_guide_email_list) && !empty($this->user->house->local_guide_email_list) && $this->isCreating) {

                $localGuideEmailsList = explode(',', $this->user->house->local_guide_email_list);
                $localGuideEmailsList = array_merge($localGuideEmailsList, $ccList);
                $localGuideEmailsList = array_unique(array_filter($localGuideEmailsList));

                if (count($localGuideEmailsList) > 0 && !empty($localGuideEmailsList)) {
//                    $users = User::whereIn('email', $localGuideEmailsList)->where('HouseId', $this->user->HouseId)->get();
//
//                    foreach ($users as $user) {
//                        $user->notify(new LocalGuideNotification($ccList,$items,$this->user, $this->siteUrl, $createdHouseName));
//                    }
//                    $localGuideEmailsList = array_diff($localGuideEmailsList, $users->pluck('email')->toArray());
                    if (count($localGuideEmailsList) > 0) {
                        Notification::route('mail', $localGuideEmailsList)
                            ->notify(new LocalGuideNotification($ccList,$items,$this->user, $this->siteUrl, $createdHouseName));
                    }
                }
            }
        } catch (Exception $e) {

        }

//        try {
//            $items = $this->localGuide;
//            $createdHouseName = auth()->user()->house->HouseName;
//            $isAction = $this->isCreating ? 'created' : 'updated';
//
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new LocalGuideNotification($items, $isAction, $createdHouseName));
//            }
//
//        } catch (Exception $e) {
//
//        }

        $this->emitSelf('toggle', false);

        $this->success('Local Guide ' . ($this->isCreating ? 'created' : 'updated') . ' successfully.');

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
