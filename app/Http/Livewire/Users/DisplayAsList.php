<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class DisplayAsList extends Component
{
    public $searchQuery = null;

    public function render()
    {

        $users = User::query()
            ->where('user_name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('first_name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('last_name', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('email', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('is_confirmed', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('role', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('is_confirmed', 'like', '%'.$this->searchQuery.'%')
            ->orderBy('user_id','DESC')->paginate(18);

        return view('dash.users.display-as.list',compact('users'));
    }
}
