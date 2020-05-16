<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email' => 'required|email',
            'password' => 'required'
        ));

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $previousURL = Session::pull('previousURL');
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }else if($previousURL == '/login' || empty($previousURL)){
                return redirect()->intended(RouteServiceProvider::HOME);
            }
                return redirect()->intended($previousURL);

        } else {
            $validator->errors()->add('invalid_login', 'Invalid credentials!');
            return redirect(route('login'))->withErrors($validator)->withInput();
        }
    }
}
