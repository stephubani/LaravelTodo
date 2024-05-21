<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function save(Request $request){
        
        $data = $request->all();
        $user_name = $request->input('data.user_name');
        $user_email = $request->input('data.user_email');
        $user_id = $request->input('data.user_id');
        $role_id = $request->input('data.role_id');

        Validator::make( $data , [
            'data.user_name' => [
                'required',
                Rule::unique('users','name')->ignore($user_id)
            ],

            'data.user_email'=>['required','email',
            Rule::unique('users' , 'email')->ignore($user_id)
        ],
            'data.role_id'=>['required']
        ])->validate();

        if($user_id != ''){
            $user = User::find($user_id);
            $response = Gate::inspect('update', [User::class , $user ]);
            if($response->allowed()){
                $user->update([
                    'name'=>$user_name,
                    'email'=>$user_email,
                    'role_id'=>$role_id
                ]);
                $message = 'Updated Successfully';
                
                return response()->json([
                    'success'=> true,
                    'user' => $user?->load('role'),
                    'message' => $message,
                ]);

            }else{
                $message = $response->message();
                
                return response()->json([
                    'success'=>false,
                    'message' => $message,
                ]);
            }
           
            
        }else{
            $user = User::create([
            'name'=> $user_name,
            'email'=>$user_email,
            'role_id'=>$role_id,
            'password'=>'password'
            ]);

            $message = 'Created Successfully';
                
            return response()->json([
                'success'=>true,
                'user'=>$user->load('role'),
                'message' => $message,
            ]);
        }
      


    }



    public function fetch(){

        if(!Auth::user()->role->permissions->contains(fn($permission)=>$permission->name == 'View User')){
            return redirect()->route('index');
        }
        $users = User::orderBy('id', 'desc')->get();
        
        $active_role = Role::where('is_active','=','1')->get();


        return view('/users', ['users'=>$users , 'active_roles'=>$active_role]);
    }

    public function deleteUser(Request $request){
        $user_id = $request->input('user_id');
        $users=User::find($user_id);
        $users->delete();
    }

    public function toggleUser($id){
        $user= User::find($id);
        $user->toggleStatus();

        return redirect('/users');
    }

    

   

}
