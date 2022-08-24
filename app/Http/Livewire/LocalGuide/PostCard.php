<?php

namespace App\Http\Livewire\LocalGuide;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Blog\Blog;
use App\Models\LocalGuide;
use Livewire\Component;

class PostCard extends Component
{
    public LocalGuide $dt;

    use Toastr;

    public $existing_views;


//    public function mount() {
//        $blog_views = LocalGuide::where('id' ,$this->post->id)->withCount('views')->first();
//        $this->existing_views = $blog_views->views_count;
//    }

    public function render()
    {
        return view('local-guide.post-card');
    }
}
