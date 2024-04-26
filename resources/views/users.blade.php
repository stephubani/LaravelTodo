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
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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

        <div class='row g-2'>
            <h4>{{ session('user_active') ? 'Welcome ' . session('user_active')->name : 'User' }}</h4>
            <div class='col-auto'>
                <input type="text" class='form-control' name="username" id="user" placeholder='User-Name'>
                <input type="hidden" name="userid" id='userid' value=''>
            </div>

            <div class='col-auto'>
                <input type="email" class='form-control' name="useremail" id="useremail" placeholder='User-Email'>
            </div>

            <div class='col-auto'>
                <select name="" class='form-select' id="active_roles">
                    <option value="">Select Role</option>
                    @foreach($active_roles as $roles)
                    <option value="{{$roles->id}}">{{$roles->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class='col-auto'>
                <button class='btn btn-warning' id='save'>Create User</button>
            </div>
        </div>

        <div id='feedback'>

        </div>

        <div class='row'>
            <div class='col-md'>
                <table class='table table-striped'>
                   <thead>
                        <th>User Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Edit</th>
                   </thead>
                   <tbody id='user_details'>
                    @foreach($users as $user)
                    
                        <tr id='{{$user->id}}'>
                            <td class='rolename'>{{$user->role?->name}}</td>
                            <td class='username'>{{$user->name}}</td>
                            <td class='useremail'>{{$user->email}}</td>
                            <td>
                                <a href="/users/{{$user->id}}/toggle">
                                    <button id= 'click' class='btn <?php echo $user->is_active ? "btn-warning" : "btn-secondary" ?>'>{{$user->displayStatusOfUser()}}</button>
                                </a>
                                
                            </td>
                            <td>
                                <button class='btn editbtn'id='edit_btn{{$user->id}}' >
                                    <input type="hidden" name="rolesid" class='role_id'value='{{$user->role?->id}}'>
                                    <input type="hidden" name="userid" class='user_id' value='{{$user->id}}'>
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button class='btn delete' id='delete_btn{{$user->id}}'>
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>
            </div>
        </div>

    </div>
   <script src='/js/jquery.min.js'></script> 
   <script src='/js/user.js'></script>
</body>
</html>