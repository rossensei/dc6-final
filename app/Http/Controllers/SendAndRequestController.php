<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SendAndRequestController extends Controller
{
    public function send()
    {
        $users = User::select('id', 'name' , 'email')->get();

        return inertia('SendAndRequest/Send', [
            'users' => $users
        ]);
    }
}
