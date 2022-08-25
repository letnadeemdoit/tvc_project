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

        $guide_Likes = LocalGuide::where('user_id' ,$this->post->user_id)->where('id' ,$this->post->id)->first();
        if (count($guide_Likes->likes) > 0){
            $this->isExistingUser = true;
        }
    }

    public function render()
    {
        return view('blog.like-able-blog');
    }

    public function likeBlog(Request $request){

        if ($this->isExistingUser){
            $guide_Likes = Likes::where('user_id' ,$this->post->user_id)->where('likeable_id' ,$this->post->id)->first();
            if ($guide_Likes){
                $guide_Likes->delete();
                $this->existing_likes = $this->existing_likes-1;
                $this->isExistingUser = false;
            }
            $this->emit('guide-likes-cu-successfully');
        }
        else{
            $guide_Likes = LocalGuide::where('user_id' ,$this->post->user_id)->where('id' ,$this->post->id)->first();
            if (count($guide_Likes->likes) == 0){
                $like = new Likes();
                $like->fill([
                    'user_id' => $this->post->user_id,
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
