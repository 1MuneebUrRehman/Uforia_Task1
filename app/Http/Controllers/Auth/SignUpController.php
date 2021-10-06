<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailJob;
use App\Models\Role;

class SignUpController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }
    public function create(Request $request)
    {
        // Validation
        $request->validate([
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:6|max:255',
            'address' => 'required|max:255',
        ]);
        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address']
        ]);

        $user->roles()->attach(Role::where('name', 'user')->first());
        if ($user->email_verified_at == null) {
            // dispatch(new SendEmailJob($user));
            return redirect()->route('email.verified');
        }
    }
}
