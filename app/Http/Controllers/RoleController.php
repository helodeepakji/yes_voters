<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('role-list', compact('roles'));
    }

    public function saveRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string',
        ]);

        Role::create([
            'role_name' => $request->role_name
        ]);

        return back()->with('success', 'Role Create Successfully');
    }

    public function getRole($id)
    {
        $role = Role::where('id',$id)->first();
        return response()->json($role);
    }
    
    public function deleteRole($id)
    {
        if($id == 1){
            return back()->with('error','Admin Role is not delete.');
        }
        $role = Role::where('id',$id)->first();
        $role->delete();
        return back()->with('success','Delete Role Successfully.');
    }

    public function editRole(Request $request)
    {

        $request->validate([
            'id' => 'required|integer|exists:roles,id',
            'role_name' => 'required|string',
        ]);

        $role = Role::where('id', $request->id)->first();
        if (!$role) {
            return back()->with('error','Role not found.');
        }
        
        $role->role_name = $request->role_name;
        $role->save();        
        
        return back()->with('success','Role Save Successfully');
    }
}
