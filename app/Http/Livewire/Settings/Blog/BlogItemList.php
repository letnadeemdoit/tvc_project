<?php

namespace App\Http\Livewire\Settings\Blog;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Blog\Blog;
use App\Models\User;
use App\Notifications\BlogNotification;
use App\Notifications\DeleteBlogEmailNotification;
use App\Notifications\DeleteNotification;
use Exception;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class BlogItemList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $search = '';
    public $page = 1;
    public $per_page = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'blog-cu-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully',
    ];

    public function mount()
    {
        $this->model = Blog::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Blog::where('HouseId', $this->user->HouseId)
            ->when($this->user->is_owner_only, function ($query) {
                $query->where('user_id', $this->user->user_id);
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('Subject', 'LIKE', "%$this->search%");
                });
            })
            ->orderBy('BlogId', 'DESC')
            ->paginate($this->per_page);

        return view('dash.settings.blog.blog-items-list', compact('data'));
    }


    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('blog-cu-successfully');

        $title = $data['Subject'];
        $createdHouseName = $this->user->house->HouseName;

        $owner = null;
        if (!empty($data['user_id'])) {
            $owner = User::where('user_id', $data['user_id'])->first();
        }
        $ccList = [];
        if ($owner && $owner->email) {
            $ccList[] = $owner->email;
        }

        try {

            if (!is_null($this->user->house->BlogEmailList) && !empty($this->user->house->BlogEmailList)) {

                $blogEmailsList = explode(',', $this->user->house->BlogEmailList);

                if (count($blogEmailsList) > 0 && !empty($blogEmailsList)) {

                    $users = User::whereIn('email', $blogEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteBlogEmailNotification($ccList,$title,$this->user,$createdHouseName));
                    }

                    $blogEmailsList = array_diff($blogEmailsList, $users->pluck('email')->toArray());

                    if (count($blogEmailsList) > 0) {

                        Notification::route('mail', $blogEmailsList)
                            ->notify(new DeleteBlogEmailNotification($ccList,$title,$this->user,$createdHouseName));

                    }
                }
            }
        } catch (Exception $e) {

        }
    }

    public function destroy($id)
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent
            );
        }
    }

}
