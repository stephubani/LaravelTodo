<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    //

    public function show($id=null){
        $permissions = Permission::orderBy('id', 'desc')->get();
        $data = [
            'permissions'=>$permissions
        ];
        if($id){
            $a_permission = Permission::find($id);
            $data['a_permission'] = $a_permission;
        }
        return view('permissions', $data);
    }

    public function create(Request $request){
        $data = $request->all();
        $permission_name = $request->input('permission');
        $permission_description = $request->input('description');
        Validator::make($data ,[ 
            'permission'=> ['required','unique:permissions,name'],
            'description'=> ['required']
        ])->validate();
        $permissions = Permission::create([
            'name'=> $permission_name,
            'description'=>$permission_description
        ]);

        return redirect()->route('permissions')->with('success' , 'Created Successfully');
    }

    public function update(Request $request){
        $data = $request->all();
        $permission_name = $request->input('permission');
        $permission_description = $request->input('description');
        $permission_id = $request->input('permission_id');
        Validator::make($data ,[ 
            'permission'=> ['required',   Rule::unique('permissions', 'name')->ignore($permission_id)],
            'description'=> ['required']
        ])->validate();
        $permission = Permission::find($permission_id);
        $permission->update([
            'name'=>$permission_name,
            'description'=>$permission_description
        ]);
        return redirect()->route('permissions')->with('success', 'Updated Successfully');
    }

    public function delete($id){
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permissions')->with('success', 'Deleted Successfully');
    }
}
