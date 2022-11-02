<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Models\LocalGuide;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CommentForm extends Component
{

    public $state = [];

    public ?LocalGuide $localGuide;

    public function render()
    {
        $comments = $this->localGuide->comments()->paginate(10);

        return view('comments.comment-card',compact('comments'));
    }

    public function saveComment(){

        $inputs = $this->state;
        Validator::make($inputs, [
            'message' => 'required',
        ])->validateWithBag('saveComment');

        $comment = new Comment;

        $comment->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'message' => $inputs['message'] ?? null,
        ]);

        $this->localGuide->comments()->save($comment);

    }

}
