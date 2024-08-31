<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // $data['users'] = User::all();
        $users= User::all();
        // dd($users);
        return view('frontpage.blog', compact('users'));
        // return "Hello Home Page";
    }
}