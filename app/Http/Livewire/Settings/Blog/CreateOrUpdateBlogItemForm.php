<?php

namespace App\Http\Livewire\Settings\Blog;

use App\Models\Blog\Blog;
use App\Http\Livewire\Traits\Toastr;
use App\Models\Blog\BlogComment;
use App\Models\BlogPivot;
use App\Models\Category;
use App\Models\House;
use App\Models\Tag;
use App\Models\TagBlog;
use App\Models\User;
use App\Notifications\BlogNotification;
use App\Notifications\BlogNotify;
use App\Models\Tags;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateBlogItemForm extends Component
{
    use WithFileUploads;
    use Toastr;

    public $user;

    public $name;

    public $siteUrl;

    public $state = [];
    public $isCreating = false;
    public $file;

    public $existingTags;

    public $blogCategories;

    public ?Blog $blogItem;

    protected $listeners = [
        'showBlogCUModal',
    ];

    public function mount()
    {
        $this->blogCategories = Category::where('type', 'blog')->where('house_id', $this->user->HouseId)->get();
    }

    public function render()
    {
        return view('dash.settings.blog.create-or-update-blog-item-form');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showBlogCUModal($toggle, ?Blog $blogItem)
    {
        $this->emitSelf('toggle', $toggle);
        $this->blogItem = $blogItem;
        $this->reset(['state', 'file']);

        if ($blogItem->BlogId) {
            $this->isCreating = false;
            $this->state = \Arr::only($blogItem->toArray(), ['Subject', 'Contents', 'image', 'category_id', ' name']);
            $this->state['tags'] = $blogItem->tags->pluck('name')->toArray();
        } else {
            $this->isCreating = true;
        }
    }

    public function saveBlogItemCU()
    {
        $this->resetErrorBag();
        $date = date('Y/m/d H:i:s');
        $inputs = $this->state;
        if ($this->file) {
            $inputs['image'] = $this->file;
        } else {
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'Subject' => [
                'required', 'string', 'max:100',
                $this->isCreating ? Rule::unique('Blog')->where(function ($query) {
                    return $query->where('HouseId', $this->user->HouseId);
                }) : 'required',
            ],
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'Contents' => 'required|max:4000000000',
            'category_id' => 'required',
        ])->validateWithBag('saveBlogItemCU');

        if ($this->isCreating){
            $this->blogItem->user_id = $this->user->user_id;
            $this->blogItem->HouseId = $this->user->HouseId;
            $this->blogItem->Author = $this->user->first_name." ".$this->user->last_name;
            $this->blogItem->BlogDate = $date;
            $this->blogItem->Audit_user_name = $this->user->Audit_user_name;
            $this->blogItem->Audit_Role = $this->user->Audit_Role;
            $this->blogItem->Audit_FirstName = $this->user->Audit_FirstName;
            $this->blogItem->Audit_LastName = $this->user->Audit_LastName;
            $this->blogItem->Audit_Email = $this->user->Audit_Email;
        }
        $slug = Str::slug($inputs['Subject']);
        $this->blogItem->fill([
                'Subject' => $inputs['Subject'],
                'Contents' => $inputs['Contents'] ?? '',
                'category_id' => $inputs['category_id'] ?? null,
                'slug' => $slug,
            ])->save();

//        $tagIds = [];
//
//        if (isset($this->state['tags']) && is_array($this->state['tags'])) {
//            foreach($this->state['tags'] as $tag) {
//                $t = Tag::firstOrNew([
//                    'name' => $tag
//                ]);
//
//                if (!$t->exists) {
//                    $t->save();
//                }
//
//                $tagIds[] = $t->id;
//            }
//        }
//
//        $this->blogItem->tags()->detach($this->blogItem->tags->pluck('id')->toArray());
//        $this->blogItem->tags()->attach($tagIds);

        $this->blogItem->updateFile($this->file);


        try {
            $this->siteUrl = route('guest.blog.show', $slug);

            $items = $this->blogItem;
            $createdHouseName = $this->user->house->HouseName;
            $blogUrl = $this->siteUrl;
            $isAction = $this->isCreating ? 'created' : 'updated';

            if (!is_null($this->user->house->BlogEmailList) && !empty($this->user->house->BlogEmailList)) {

                $blogEmailsList = explode(',', $this->user->house->BlogEmailList);
                if (count($blogEmailsList) > 0 && !empty($blogEmailsList)) {
                    $users = User::whereIn('email', $blogEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new BlogNotification($items, $blogUrl,$isAction, $createdHouseName));
                    }
//                Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
                    $blogEmailsList = array_diff($blogEmailsList, $users->pluck('email')->toArray());
                    if (count($blogEmailsList) > 0) {
                        Notification::route('mail', $blogEmailsList)
                            ->notify(new BlogNotification($items, $blogUrl,$isAction, $createdHouseName));
                    }
                }
            }
        } catch (Exception $e) {

        }

        $this->emitSelf('toggle', false);

        $this->success('Blog ' . ($this->isCreating ? 'created' : 'updated') . ' successfully.');
        $this->emit('blog-cu-successfully');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->blogItem->BlogId) {
            $this->blogItem->deleteFile('image');
            $this->emit('blog-deleted-successfully');
        }
    }


}
