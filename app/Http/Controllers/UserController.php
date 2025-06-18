<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $role = Role::all();
        $users = User::with('role')->get();
        return view('user-list', compact('users', 'role'));
    }

    public function getUser($id)
    {
        $users = User::where('id', $id)->first();
        return response()->json($users);
    }

    public function deleteUser($id)
    {
        $users = User::where('id', $id)->first();
        $users->delete();
        return back()->with('success', 'Users Delete Successfully');
    }

    public function saveUser(Request $request)
    {

        $request->validate([
            'role_id' => 'required|integer|exists:roles,id',
            'full_name' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits_between:7,15|unique:users,phone',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'password' => 'password123',
        ]);

        return back()->with('success', 'Users Create Successfully');
    }

    public function editUser(Request $request)
    {

        $request->validate([
            'role_id' => 'nullable|integer|exists:roles,id',
            'user_id' => 'required|integer|exists:users,id',
            'full_name' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits_between:7,15',
            'email' => 'required|email',
        ]);

        $user = User::where('id', $request->user_id)->first();
        $user->name = $request->full_name;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        return back()->with('success', 'Users Update Successfully');
    }
}
