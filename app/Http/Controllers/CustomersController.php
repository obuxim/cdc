<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Customer {
    var $id = '';
    var $name = '';
    var $email = '';
    var $phone = '';
    var $gender = '';
    var $area = '';
    var $city = '';
    public function populateWith(User $user)
    {
        $profile = $user->profile;
        $this->id = $user->id;
        $this->name = $profile->firstName . ' ' . $profile->lastName;
        $this->email = $user->email;
        $this->phone = $profile->phone;
        $this->gender = $profile->gender;
        $this->area = $profile->area;
        $this->city = $profile->city;
    }
}

class CustomersController extends Controller
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
    // Index Method
    public function index()
    {
        $customers = [];
        $users = User::where('role', 'customer')->get();
        foreach($users as $user){
            $customer = new Customer();
            $customer->populateWith($user);
            array_push($customers, $customer);
        }
        return view('admin.customers.index')->with('customers', $customers);
    }
    // Show Method
    public function show($id)
    {
        $user = User::findOrFail($id);
        $profile = $user->profile;
        return view('admin.customers.show')->with(['user' => $user, 'profile' => $profile]);
    }
    // Edit Page
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $profile = $user->profile;
        return view('admin.customers.edit')->with(['user' => $user, 'profile' => $profile]);
    }
    // Update Handler
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentEmail = $user->email;
        $profile = $user->profile;
        $validator = Validator::make($request->all(), array(
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ));
        if($validator->fails()){
            return redirect(route('admin.customer.edit', $user->id))->withErrors($validator)->withInput();
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
            return redirect(route('admin.customer.show', $user->id))->with('successes', ['Successfully updated profile!']);
        }catch (QueryException $e){
            $validator->errors()->add('could_not_save', 'Could not save profile due to database issue!');
            return redirect(route('admin.customer.edit', $user->id))->withErrors($validator)->withInput();
        }
    }
    // Destroy Customer
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $profile = $user->profile;
        $profile->delete();
        $user->delete();
        return redirect(route('admin.customer.index'))->with('successes', ['Successfully deleted!']);
    }
    // Create Customer
    public function create()
    {
        return view('admin.customers.create');
    }
    // Store Customer
    public function store(Request $request)
    {
        $user = new User();
        $profile = new Profile();
        $validator = Validator::make($request->all(), array(
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ));
        if($validator->fails()){
            return redirect(route('admin.customer.create'))->withErrors($validator)->withInput();
        }
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
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
            $user->profile()->save($profile);
            return redirect(route('admin.customer.show', $user->id))->with('successes', ['Customer successfully created!']);
        }catch (QueryException $e){
            dd($e);
            $validator->errors()->add('could_not_save', 'Could not save profile due to database issue!');
            return redirect(route('admin.customer.create'))->withErrors($validator)->withInput();
        }
    }
}
