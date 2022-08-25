<?php

namespace App\Http\Livewire\LocalGuide\SingleGuide;

use App\Models\LocalGuide;
use Livewire\Component;

class LatestGuides extends Component
{
    public $user;
    public $search;

    public LocalGuide $post;

    public function render()
    {
        $data = LocalGuide::where('house_id', $this->user->HouseId)
            ->latest('id')
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('title', 'LIKE', "%$this->search%");
                });
            })
            ->paginate(5);
        return view('local-guide.single-guide.latest-guides', compact('data'));
    }
}
