<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Events\ModelAudited;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dash.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreatesNewUsers $newUser)
    {

        $user =  $newUser->create($request->all());

        ModelAudited::dispatch($user, auth()->user());

        return redirect()->route('users.index')->with('success', 'New User Created Successfully');

//        $data = [
//            'Audit_user_name' => auth()->user()->user_name,
//            'Audit_Role' => auth()->user()->role,
//            'Audit_FirstName' => auth()->user()->first_name,
//            'Audit_LastName' => auth()->user()->last_name,
//            'Audit_Email' => auth()->user()->email,
//            'old_password' => auth()->user()->old_password,
//        ];
//
//        $user->update($data);
//
//        $user->fresh();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateUserProfileInformation $updateUserProfileInformation)
    {
        dd("ok");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
