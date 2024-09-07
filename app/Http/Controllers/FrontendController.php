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
        return view('preschool.index', compact('users'));
        // return "Hello Home Page";
    }
    public function about()
    {
        return view('preschool.about');
    }
    public function classes(){
        return view('preschool.classes');
    }
    public function contact()
    {
        return view('frontpage.contact');

    }
    public function blog()
    {
        $users=User::all();
        return view('frontpage.blog', compact('users'));
    }
}