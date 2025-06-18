<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile',compact('user'));
    }
    
    public function userProfile($id)
    {
        $user = User::find($id);
        return view('profile',compact('user'));
    }

    public function editprofile($id,Request $request)
    {
        $user = User::find($id);

        // Validate the request
        $request->validate([
            'name'  => 'required|string|max:255',
            'bio'   => 'nullable|string|max:1000',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name  = $request->name;
        $user->bio   = $request->bio;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                Storage::delete('public/profiles/' . $user->profile);
            }
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $imagePath;
        }

        $user->save();

        return back()->with('success','Profile Update Successfully.');
    }
    
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'password'  => 'required|string|max:255',
            'cpassword'   => 'nullable|string|max:1000',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Profile Update Successfully.');
    }
}