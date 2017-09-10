<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/advance';

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'website'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Check if the user can register
         */
        $this->middleware('guest');
        if(setting('user.register', settingParent('app')) == 'false'){
            echo "<h1 style='text-align:center;'>Access to registration page is not allowed, contact the administrator to register you!</h1>";
            echo "<h1 style='text-align:center;'>Or login using the link below</h1>";
            echo "<h1 style='text-align:center;'><a href='" . route('login') . "'>Log In</a> </h1>";
            exit;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|min:5|max:50',
            'last_name' => 'required|string|min:5|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'website' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string',
            'mobile' => 'required|string|unique:users',
        ], [
            'first_name.require' => 'You need your first name in registering',
            'first_name.min' => 'Make sure that the first name is more than 5 in length!',
            'last_name.require' => 'You need your last name in registering',
            'last_name.min' => 'Make sure that the last name is more than 5 in length!',
            'website.require' => 'You must be a website owner in order to register',
            'website.unique' => 'This website already belongs to a user!',
            'password.require' => 'Make sure to fill in the password field!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //User Class 
        $user = new User();
        //Variable storing the default image to be used for the user based on their gender
        $image = $user->assignImage($data['gender']);
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'website' => $data['website'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'image' => $image,
            'password' => bcrypt($data['password']),
        ]);

        /**
         * Assign a role to the user trying to register
         */
        userRole($user->id, '1');

        return $user;
    }

}
