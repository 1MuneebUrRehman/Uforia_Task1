<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all()->except(Auth::user()->id);
        $roles = Role::all();
        return view('dashboard', compact('users', 'roles'));
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
    public function rolesEdit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('roles.edit', compact('user', 'roles'));
    }
    public function rolesUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $user->roles()->detach();
        if ($request['user']) {
            $user->roles()->attach(1);
        }
        if ($request['designer']) {
            $user->roles()->attach(2);
        }
        if ($request['developer']) {
            $user->roles()->attach(3);
        }
        return redirect()->back();
    }
}
