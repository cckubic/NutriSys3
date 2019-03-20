<?php

namespace nutrisys3\Http\Controllers\Profile;

use Illuminate\Http\Request;
use nutrisys3\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function updateAuthUser (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'.Auth::id()
        ]);

        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->save();

        return $user;
    }
}
