<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class DisplayAsList extends Component
{
    public function render()
    {

        $users = User::orderBy('user_id','DESC')->paginate(18);

        return view('dash.users.display-as.list',compact('users'));
    }
}
