<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);
        $user =  User::where('email', $request->input('email'))->first();
        // Check if Email and Password are Same
        if ($user && Hash::check($request->input('password'), $user->password)) {
            if ($user->email_verified_at) {
                Auth::login($user);
                // Event Trigger
                return redirect()->route('dashboard');
            }
            else{
                return redirect()->route('email.verified');
            }
        } else {
            return redirect('/signin')->with('error', 'Your Account not Found...!');
        }
    }
}
