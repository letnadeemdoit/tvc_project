<?php

namespace App\Http\Livewire\Review;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Comment;
use App\Models\LocalGuide;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ReviewForm extends Component
{
    use Toastr;

    public $orderBy = 'DESC';

    public $state = [];

    public ?LocalGuide $localGuide;

    protected $listeners = [
        'refresh-reviews' => '$refresh',
    ];

    public function render()
    {
        $reviews = $this->localGuide->reviews()->paginate(10);
        $user = $this->localGuide->reviews()->where('user_id',auth()->user()->user_id)->first();
        $totalReviewLocalGuide = $this->localGuide->reviews()->orderBy('id',$this->orderBy)->get();

        $sumTotalReviews = count($totalReviewLocalGuide);


        $countAllRatingOne = count($this->localGuide->reviews()->where('rating', 1)->get());
        $countAllRatingTwo = count($this->localGuide->reviews()->where('rating', 2)->get());
        $countAllRatingThree = count($this->localGuide->reviews()->where('rating', 3)->get());
        $countAllRatingFour = count($this->localGuide->reviews()->where('rating', 4)->get());
        $countAllRatingFive = count($this->localGuide->reviews()->where('rating', 5)->get());



        if (isset($sumTotalReviews) && $sumTotalReviews > 0){

            $allRatingOne = ($countAllRatingOne * 100) / $sumTotalReviews;
            $allRatingTwo = ($countAllRatingTwo * 100) / $sumTotalReviews;
            $allRatingThree = ($countAllRatingThree * 100) / $sumTotalReviews;
            $allRatingFour = ($countAllRatingFour * 100) / $sumTotalReviews;
            $allRatingFive = ($countAllRatingFive * 100) / $sumTotalReviews;

            return view('reviews.review-card',compact('reviews','user','totalReviewLocalGuide',
                'allRatingOne', 'allRatingTwo', 'allRatingThree', 'allRatingFour', 'allRatingFive',
                'countAllRatingOne', 'countAllRatingTwo', 'countAllRatingThree', 'countAllRatingFour', 'countAllRatingFive'
            ));
        }else{

            return view('reviews.review-card',compact('reviews','user','totalReviewLocalGuide',
                'countAllRatingOne', 'countAllRatingTwo', 'countAllRatingThree', 'countAllRatingFour', 'countAllRatingFive'
            ));

        }


    }

    public function saveRatingForm(){

        $inputs = $this->state;

        Validator::make($inputs, [
            'rating' => 'required',
        ])->validateWithBag('saveRatingForm');

        $remark = new Review();

        $remark->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'rating' => $inputs['rating'] ?? null,
            'remarks' => $inputs['remarks'] ?? null,
        ]);

        $this->success('Your review saved Successfully');

        $this->localGuide->reviews()->save($remark);

        $this->state = '';

        $this->emit('refresh-reviews');

    }

}
