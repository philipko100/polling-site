<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{

    public function show($id)
    {
        if(Auth::Guest()) {
            return redirect('/login')->with('error', 'You need to log in to view other people\'s profiles');
        }
        $user = User::find($id);
        return view('auth.show')
            ->with('user', $user);
    }
    public function usernameShow($username)
    {
        if(Auth::Guest()) {
            return redirect('/login')->with('error', 'You need to log in to view other people\'s profiles');
        }
        $user = User::where('username', $username)->first();
        return view('auth.show')
            ->with('user', $user);
    }

    public function edit ($id)
    {
        // Check for correct user
        if(auth()->user()->id == $id){
            return view('auth.edit')->with('userid', $id);
        }

        if(auth()->user()->id !== $id){
            return redirect('/')->with('error', 'Unauthorized page');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'political_position' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'occupation'=> 'required',
            'income_level' => 'required',
            'education_level' => 'required',
            'race_origin' => 'required',
            'current_city' => 'required',
            'current_province' => 'required',
            'current_country' => 'required'
        ]);
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->political_position = $request->input('political_position');
            $user->birth_date = $request->input('birth_date');
            $user->gender = $request->input('gender');
            $user->occupation = $request->input('occupation');
            $user->income_level = $request->input('income_level');
            $user->education_level = $request->input('education_level');
            $user->race_origin = $request->input('race_origin');
            $user->current_city = $request->input('current_city');
            $user->current_province = $request->input('current_province');
            $user->current_country = $request->input('current_country');
            $user->hometown_city = $request->input('hometown_city');
            $user->hometown_province = $request->input('hometown_province');
            $user->hometown_country = $request->input('hometown_country');
            $user->religion = $request->input('religion');
            $user->save();

        return redirect("/profile/$user_id")->with('success', 'Profile Edited');
    }
}
