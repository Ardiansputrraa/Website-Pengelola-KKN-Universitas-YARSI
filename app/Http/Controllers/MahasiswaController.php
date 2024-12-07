<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
}
