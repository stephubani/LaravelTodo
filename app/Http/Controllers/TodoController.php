<?php

namespace App\Http\Controllers;

use App\Events\CompletedTodo;
use App\Events\TodoAssigned;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $todo_name = $request->input('todoname');
        $user_id = $request->input('activeuser');

        $validator = Validator::make($data , [
                    'todoname' => ['required','unique:todos,name'],
                    'activeuser'=>['required']
                    ])->validate();

        $todo = Todo::create([
            'name'=>$todo_name,
            'user_id'=>$user_id
        ]);

        TodoAssigned::dispatch($todo);
      

        return redirect()->route('index')->with('success' , 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        $todos = Todo::orderBy('id', 'desc')->get();
        $active_user = User::where('is_active' , '=' , '1')->get();
        $data = [
            'todos'=>$todos,
            'active_users'=>$active_user,
        ];
        if($id){
            $todo = Todo::find($id);
            $data['todo'] = $todo;
        } 
        return view('index' , $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       $data = $request->all();
       $todo_id = $request->input('todo_id');
       $todo_name = $request->input('todoname');
       $user_id = $request->input('activeuser');

        $validator = Validator::make($data , [
            'todoname' => ['required',
                Rule::unique('todos', 'name')->ignore($todo_id)
        ],
            'activeuser'=>['required']
            ])->validate();
        $todo = Todo::find($todo_id);
        $todo->update([
            'name'=>$todo_name,
            'user_id'=>$user_id
        ]);

        return redirect()->route('index')->with('success' , 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('index')->with('success' , 'Deleted Successfully');
    }

    public function markAsCompleted($id ){
        $todo = Todo::find($id);

        $todo->update([
            'is_completed'=> 1,
            'completed_at'=>now()
        ]);

        CompletedTodo::dispatch($todo);

        return redirect()->route('index')->with('success', 'Todo Completed');

    }

   
}
