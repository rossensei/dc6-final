<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function landing()
    {
        return inertia('CustomAuth/Login');
    }

    public function login()
    {
        return inertia('CustomAuth/Login');
    }

    public function register()
    {
        return inertia('CustomAuth/Register');
    }
}
