<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    //
    public function createAndEditRole(Request $request){
        $data = $request->all();
        $role_id = $request->input('data.role_id');
        $permissions = $request->input('data.permissions');
        $validator = Validator::make($data, [

            'data.role_name' => [
                'required',
                Rule::unique('roles' , 'name')->ignore($role_id)
            ]
        ])->validate();


        $role_name = $request->input('data.role_name');
        if($role_id != ''){
            $response = Gate::inspect('update', Role::class);
            if($response->allowed()){
                $role = Role::find($role_id);
                $role->update(['name'=>$role_name]);
                $role->permissions()->sync($permissions);

                $message = 'Updated Successfully';
                return response()->json([
                    'success'=> true,
                    'role' => $role?->load('permissions'),
                    'message' => $message,
                ]);
            }else{
                $message = $response->message();
                return response()->json([
                    'success'=> false,
                    'message' => $message,
                ]);
            }
            
        }else{
            $role = Role::create([
                'name'=> $role_name
            ]);
            $message = 'Created Successfully';
            $role->permissions()->sync($permissions);
            return response()->json([
                'success'=> true,
                'role'=>$role->load('permissions'),
                'message' => $message,
            ]);
        }

       
       
    }

    public function fetchRoles() {
        $roles = Role::orderBy('id', 'desc')->get();
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('roles', [ 'roles'=> $roles , 'permissions'=>$permissions]);
    }

    public function toggle($id){
        $role = Role::find($id);
        $role->toggleStatus();

        return redirect('/roles');
    }

    public function delete($id){
        $response = Gate::inspect('destroy', Role::class);
        if($response->allowed()){
            $role = Role::find($id);
            $role->permissions()->detach();
            $role->delete();

            $message = 'Deleted Successfully';
                
            return response()->json([
                'success'=> true,
                'message' => $message,
            ]);

        }else{
            $message = $response->message();
            return response()->json([
                'success'=> false,
                'message' => $message,
            ]);
        }
       
    }

}
