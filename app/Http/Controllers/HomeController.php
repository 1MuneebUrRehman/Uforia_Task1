<?php

namespace App\Http\Controllers;

use App\Jobs\updatedRolesJob;
use App\Models\Role;
use App\Models\RoleUser;
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
        $user = null;
        $designer = null;
        $developer = null;

        $userData = User::find($id);

        $userData->roles()->detach();
        if ($request['user']) {
            $userData->roles()->attach(1);
        }
        if ($request['designer']) {
            $userData->roles()->attach(2);
        }
        if ($request['developer']) {
            $userData->roles()->attach(3);
        }
        $userRoles = RoleUser::where('user_id', $userData->id)->join('roles', 'roles.id', 'role_id')->get();
        foreach ($userRoles as $userRole) {
            if ($userRole->name == 'user') {
                $user = 'user';
            }
            if ($userRole->name == 'designer') {
                $designer = 'designer';
            }
            if ($userRole->name == 'developer') {
                $developer = 'developer';
            }
        }
        dispatch(new updatedRolesJob($userData->email ,$user, $designer, $developer));

        return redirect()->back();
    }
}
