<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class DisplayAsList extends Component
{
    public function render()
    {

        $users = User:: paginate(18);

        return view('dash.user.display-as.list',compact('users'));
    }
}
