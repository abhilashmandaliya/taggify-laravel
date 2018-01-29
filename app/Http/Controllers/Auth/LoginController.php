<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Authenticate the user
     * 
     * @param Illuminate\Http\Request $request
     * @return string json string if the device is android mobile
     * @return Respone if the device is web browser
     */
    public function login(Request $request)
    {
        $device = $request->input('device');
        $email = $request->input('email');
        $password = $request->input('password');

        $authenticated = Auth::attempt(['email' => $email, 'password' => $password]);
        
        if(is_null($device)) // web request
        {
            return response()->redirectTo($authenticated ? '/home' : '/login');
        }
        else if(strcasecmp($device, "android") === 0) // android request
        {
            $status = $authenticated ? 200 : 401;
            $message = $authenticated ? "Login Successfull" : "Unauthorized";
            return  json_encode([
                                'status' => $status,
                                'message' => $message
                                ]);
        }
    }
}
