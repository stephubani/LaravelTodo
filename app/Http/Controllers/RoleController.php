<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function createAndEditRole(Request $request){
        $data = $request->all();
        $role_id = $request->input('data.role_id');
        
        Validator::make($data, [

            'data.role_name' => [
                'required',
                Rule::unique('roles')->ignore($role_id)
            ]
        ]);
        

        $role_name = $request->input('data.role_name');
        if($role_id != ''){
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
