<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image file
        ]);

        $avatarName = null;
        if ($request->hasFile('avatar')) {
            $avatarContents= $request->file('avatar')->get();
               // Generate a unique file name for the avatar
               $avatarName = 'avatar_' . Str::random($length = 10) . '.jpg';

               // Define the storage path
               $path = 'public/avatars/' . $avatarName;

               // Store the avatar locally
               Storage::put($path, $avatarContents);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'telegram_id' => $request->telegram_id,
            'password' => Hash::make($request->password),
            'type' => $request->type ?? 0,
            'phone' => $request->phone,
            'address' => $request->address,
            // 'avatar' => $avatarPath,
            'avatar' => 'storage/avatars/' . $avatarName,
            'status' => $request->status ?? 0,
            'api_token' => Str::random(80),
            'remember_token' => Str::random(100),
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }


    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|min:8', // Password is optional on update
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
            }

            $avatarContents = $request->file('avatar')->get();
            // Generate a unique file name for the avatar
            $avatarName = 'avatar_' . Str::random(10) . '.jpg';

            // Define the storage path
            $path = 'public/avatars/' . $avatarName;

            // Store the avatar locally
            Storage::put($path, $avatarContents);

            // Update the avatar path in the user record
            $user->avatar = 'storage/avatars/' . $avatarName;
        }

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->telegram_id = $request->telegram_id;
        $user->type = $request->type ?? 0;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status ?? 0;

        // Update the password if it was provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user record
        $user->save();

        return response()->json(['success' => true, 'user' => $user]);
    }


     public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success' => true]);
    }



    public function profile(User $user) {
        // dd($user);
        return view('admin.users.profile', compact('user'));
    }
}