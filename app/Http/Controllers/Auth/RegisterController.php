<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

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
        // Array of predefined image URLs
        $avatars = [
            'https://media.nngroup.com/media/people/photos/20211213_Vegas-garrett.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Evan_Headshot.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/IMG_6074.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Hayat_Sheikh.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2023-04-portraits--huei-hsin.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2022-portrait-page-3.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2023-04-portrait-megan-c.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2023-04-portraits-raluca.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Tim-portrait-2022.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Kate-Headshot-2022.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
        ];

            // Fetch the avatar from the URL
            $avatarContents = Http::get($avatars[array_rand($avatars)])->body();

            // Generate a unique file name for the avatar
             $avatarName = 'avatar_' . Str::random($length = 10) . '.jpg';

            // Define the storage path
            $path = 'public/avatars/' . $avatarName;

            // Store the avatar locally
            Storage::put($path, $avatarContents);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(10),
            'avatar' => 'storage/avatars/' . $avatarName,
        ]);
    }
}