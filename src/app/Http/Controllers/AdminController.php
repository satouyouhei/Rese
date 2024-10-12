<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function userShow()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('admin.user', compact('users', 'roles'));
    }


    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('shop');

        return view('admin.done');
    }

}
