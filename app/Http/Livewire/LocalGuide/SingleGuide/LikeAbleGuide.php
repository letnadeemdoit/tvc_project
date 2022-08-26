<?php

namespace App\Http\Livewire\LocalGuide\SingleGuide;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Likes;
use App\Models\LocalGuide;
use Illuminate\Http\Request;
use Livewire\Component;

class LikeAbleGuide extends Component
{
    public LocalGuide $post;
    use Toastr;
    public $isExistingUser = false;

    public $existing_likes;

    protected $listeners = [
        'guide-likes-cu-successfully' => '$refresh',
    ];

    public function mount(){
        $guide_Likes = $this->post->likes;
        $this->existing_likes = count($guide_Likes);

        $user = auth()->user();

        $guide_Likes = Likes::where('user_id' ,$user->user_id)->where('likeable_id' ,$this->post->id)->first();
        if ($guide_Likes){
            $this->isExistingUser = true;
        }
    }

    public function render()
    {
        return view('blog.like-able-blog');
    }

    public function likeBlog(Request $request){

        $user = auth()->user();
        if ($this->isExistingUser){
            $guide_Likes = Likes::where('user_id' ,$user->user_id)->where('likeable_id' ,$this->post->id)->first();
            if ($guide_Likes){
                $guide_Likes->delete();
                $this->existing_likes = $this->existing_likes-1;
                $this->isExistingUser = false;
            }
            $this->emit('guide-likes-cu-successfully');
        }
        else{
            $guide_Likes = Likes::where('user_id' ,$user->user_id)->where('likeable_id' ,$this->post->id)->first();
            if (is_null($guide_Likes)){
                $like = new Likes();
                $like->fill([
                    'user_id' => $user->user_id,
                    'ip_address' => $request->getClientIp(),
                    'likes' => 1,
                ]);

                $this->post->likes()->save($like);

                $this->existing_likes = $this->existing_likes+1;
                $this->isExistingUser = true;
            }

            $this->emit('guide-likes-cu-successfully');
        }

    }
}
