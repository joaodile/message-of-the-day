<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    
    public function index(User $user): View
    {
        return view('profile', compact('user'));
    }

}
