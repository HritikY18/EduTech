<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role' =>['required','string'],
            'name' => ['required', 'string','max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'profile' => ['required', 'image', 'max:2048'], // max 2MB, image file type
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:10','min:10', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'gender' =>['required','string'],
            'dob' =>['required','date'],
            'address' => ['required', 'string', 'max:255'],
        ]);
    }

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Handle profile image upload
        // $profileImagePath = null;
        // if (request()->hasFile('profile')) {
        //     $image = request()->file('profile');
        //     $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/profile_images', $imageName); // Store in storage/app/public/profile_images directory
        //     $profileImagePath = 'storage/profile_images/' . $imageName; // Public path to access from the web
        // }

        // $profileImagePath = null;
        // if (request()->hasFile('profile')) {
        //     $profileImagePath = request()->file('profile')->store('public/profile_images');
            // $profileImagePath = str_replace('public/', 'storage/', $profileImagePath);
 
        // }

    //     $profileImageName = null;
    // if (request()->hasFile('profile')) {
    //     $profileImageName = request()->file('profile')->getClientOriginalName();
    //     request()->file('profile')->storeAs('public/profile_images', $profileImageName);
    // }

    if (request()->hasFile('profile')) {
        $profileImage = request()->file('profile');
        $profileImageName = $profileImage->getClientOriginalName();
        $path = $profileImage->store('public/profile_images');
        $profileImageName = basename($path); 
    }
        return User::create([   
            'role' => $data['role'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            // 'profile' => $data['profile'],
            'profile' => $profileImageName,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'address' => $data['address'],
        ]);
    }
}
