<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //Gravatar Function
    function get_gravatar( $email, $s = 250, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    // Show Profile
    public function index()
    {
        $user = Auth::user();
        $profile = Auth::user()->profile;
        return view('profile')->with(['user' => $user, 'profile' => $profile]);
    }

    // Edit profile requested. Update accordingly.
    public function update(Request $request)
    {
        $currentEmail = Auth::user()->email;
        $user = Auth::user();
        $profile = $user->profile;
        $validator = Validator::make($request->all(), array(
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ));
        if($validator->fails()){
            return redirect(route('user.profile'))->withErrors($validator)->withInput();
        }
        $user->email = $request->input('email');
        if($currentEmail != $request->input('email'))
        {
            $profile->gravatarURL = $this->get_gravatar($user->email);
        }

        if($request->has('password')){

        }
        $profile->firstName = $request->input('firstName');
        $profile->lastName = $request->input('lastName');
        $profile->gender = $request->input('gender');
        $profile->street = $request->input('street');
        $profile->street1 = $request->input('street1');
        $profile->area = $request->input('area');
        $profile->city = $request->input('city');
        $profile->zip = $request->input('zip');
        $profile->phone = $request->input('phone');
        try{
            $user->save();
            $profile->save();
            return redirect(route('user.profile'))->with('successes', ['Successfully updated profile!']);
        }catch (QueryException $e){
            $validator->errors()->add('could_not_save', 'Could not save profile due to database issue!');
            return redirect(route('user.profile'))->withErrors($validator)->withInput();
        }
    }

}
