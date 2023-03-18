<?php

namespace App\Http\Controllers\GetControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function search()
    {
        return view('search');
    }

    public function content($content)
    {
        return view('content');
    }

    public function login()
    {
        return view('login');
    }

    function signUp()
    {
        return view('sign-up');
    }
}
