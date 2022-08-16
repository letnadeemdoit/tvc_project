<?php

namespace App\Http\Livewire\Review;

use App\Models\Comment;
use App\Models\LocalGuide;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ReviewForm extends Component
{
    public $state = [];

    public ?LocalGuide $localGuide;

    public function render()
    {
        $reviews = $this->localGuide->reviews()->paginate(10);

        return view('reviews.review-card',compact('reviews'));
    }

    public function saveRatingForm(){

        $inputs = $this->state;

//        dd($inputs);

        Validator::make($inputs, [
            'rating' => 'required',
        ])->validateWithBag('saveRatingForm');

        $comment = new Review();

        $comment->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'rating' => $inputs['rating'] ?? null,
            'remarks' => $inputs['remarks'] ?? null,
        ]);


        $this->localGuide->reviews()->save($comment);

    }

}
