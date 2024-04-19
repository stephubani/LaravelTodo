<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function createAndEditRole(Request $request){
        $validate = $request->validate([
            'data.role_name'=>'required|string|unique:roles,name',
        ]);

        $role_name = $request->input('data.role_name');
        if($request->has('data.role_id')){
            $role_id = $request->input('data.role_id');
            $role = Role::find($role_id);
            $role->update(['name'=>$role_name]);
        }else{
            $role = Role::create([
                'name'=> $role_name
            ]);
        }
        return $role;
    }

    public function fetchRoles() {
        $roles = Role::orderBy('id', 'desc')->get();
        return view('roles', [ 'roles'=> $roles]);
    }

    public function toggle($id){
        $role = Role::find($id);
        $role->toggleStatus();

        return redirect('/roles');
    }

    public function delete($id){
        $role = Role::find($id);
        $role->delete();
    }
}
