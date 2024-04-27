<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;

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
            $user->update([
                'name'=>$user_name,
                'email'=>$user_email,
                'role_id'=>$role_id
            ]);

            $message = 'Updated Successfully';
            
        }else{
            $user = User::create([
            'name'=> $user_name,
            'email'=>$user_email,
            'role_id'=>$role_id,
            'password'=>'password'
            ]);

            $message = 'Created Successfully';
        }
        return response()->json([
            'user' => $user->load('role'),
            'message' => $message,
        ]);


    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)
        ->first();

        if($user && password_verify($password , $user->password)){
            $request->session()->put('user_active', $user);
            return redirect()->route('users')->with(['success' =>'Login Successfully']);
        }else{
            return redirect()->route('userlogin')->with('error' , 'Invalid Login Credentials');
        };
    }

    public function logout(Request $request){
        $request->session()->forget('user_active');

        return redirect()->route('users');
    }

    public function fetch(){
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
