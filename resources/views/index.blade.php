<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fa/css/all.min.css') }}">
    <title>Document</title>
</head>
<body>
    <div class='container-fluid'>
        <!-- navigation bar starts here -->
        <div class='row'>
            <div class="col-md ">
                <nav class="navbar navbar-expand-lg  bg-dark">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                
                                <li class="nav-item">
                                    <a class="nav-link active redesigned" aria-current="page" href="{{route('index')}}" style="font-size: 15px; color:white">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active redesigned" aria-current="page" href="{{route('users')}}" style="font-size: 15px; color:white">Users</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active redesigned" aria-current="page" href="{{route('roles')}}" style="font-size: 15px; color:white">
                                  Roles</a>
                                </li>
                        
                                <li class="nav-item pad">
                                    <a class="nav-link active redesigned" aria-current="page" href="{{route('userlogin')}}" style="font-size: 15px; color:white">
                                    Login</a>
                                </li>

                        

                              




                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- navigation bar ends here -->

       
        <form action="{{!isset($todo) ? '/todo/create' : '/todo/edit'}}" method='{{!isset($todo) ? "post" : "get"}}'>
            @csrf
            <div class='row g-2'>
                <h4>To-Do</h4>
                @if(session('success'))
                    <p class='text-secondary'>{{session('success')}}</p>
                @endif
                <div class='col-auto'>
                    <input type="text" class='form-control' name="todoname" id="" value='{{isset($todo) ? $todo->name : ""}}' placeholder='To-Do Name'>
                    <input type="hidden" name="todo_id" value='{{isset($todo) ? $todo->id : ""}}'>
                    <div>
                        @if ($errors->has('todoname'))
                            <p class='text-secondary'>{{$errors->first('todoname')}}</p>
                        @endif
                    </div>
                </div>
                <div class='col-auto'>
                    <select name="activeuser" id="" class='form-select'>
                        <option value="">Select A User</option>
                        @foreach($active_users as $user)
                            <option value="{{$user->id}}" {{isset($todo) && $todo->user->id == $user->id ?  'selected' : ""}}>{{$user->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @if ($errors->has('activeuser'))
                            <p class='text-secondary'>{{$errors->first('activeuser')}}</p>
                        @endif
                    </div>
                </div>

                <div class='col-auto'>
                    <button type="submit" class='btn btn-warning'>{{!isset($todo) ? 'Create User' : 'Edit User'}}</button>
                    @if(isset($todo))
                        <a href="/" class='btn btn-warning'>Cancel</a>
                   @endif
                </div>
            </div>

           
            
        </form>


        <div>
            <table class='table table-striped'>
                <thead>
                    <th>User</th>
                    <th>Todo Name</th>
                    

                </thead>
                <tbody>
                    @foreach($todos as $todo)
                        <tr>
                            <td>{{$todo->user?->name}}</td>
                            <td>{{$todo->name}}</td>
                            <td>
                                <a href="todo/{{$todo->id}}/completeTodo">
                                    <button class='btn {{$todo->is_completed ? "btn-warning" : "btn-secondary"}}'>
                                       {{$todo->displayStatus()}}
                                    </button>
                                </a>
                            </td>
                            <td>{{$todo->updated_at}}</td>
                            <td>
                                @if(!$todo->is_completed)
                                    <a href="/todo/{{$todo->id}}/fetch">
                                        <button class='btn editbtn'id='edit_btn' >
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </a>
                                @endif
                                <a href="/todo/{{$todo->id}}/delete">
                                    <button class='btn delete' id='delete_btn'>
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
          

    </div>
    
</body>
</html>