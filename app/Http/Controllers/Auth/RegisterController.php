<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\UserCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function index()
    {
        $user_categories = UserCategory::all();
        return view('auth.register', ['user_categories' => $user_categories]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_category_id' => 'required|exists:user_categories,id',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_category_id' => $data['user_category_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        if(!array_key_exists('user_category_id', $data))
        {
            $user_category = UserCategory::where('name', 'Client')->first();            
            $data['user_category_id'] = $user_category->id;
        }
        
        $user = $this->create($data);

        $device = $request->input('device');

        if(is_null($device)) // web request
        {
            Auth::login($user);
            return response()->redirectTo('/home');
        }
        else if(strcasecmp($device, "android") === 0) // android request
        {
            $status = 200;
            $message = "Registration Successfull";
            return  json_encode([
                                'status' => $status,
                                'message' => $message,
                                'data' => [
                                        'user_id' => $user->id
                                    ]
                                ]);
        }
    }
}
