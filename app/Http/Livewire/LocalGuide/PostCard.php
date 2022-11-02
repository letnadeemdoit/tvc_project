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

    public function render()
    {


        $totalReviewLocalGuide = $this->dt->reviews()->get();

        $sumTotalReviews = count($totalReviewLocalGuide);

        if (isset($sumTotalReviews) && $sumTotalReviews > 0) {
            $avgRating = intval($totalReviewLocalGuide->sum('rating') / $sumTotalReviews);
            return view('local-guide.post-card',compact('avgRating'));

        }else{

            return view('local-guide.post-card');
        }

    }
}
