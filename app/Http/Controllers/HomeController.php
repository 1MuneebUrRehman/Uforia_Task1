<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function emailVerify($id)
    {
        $user = User::find($id);
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('signin')->with('success', 'Email Verified Successfully...!');
    }
    public function emailVerified()
    {
        return view('auth.verify');
    }
}
