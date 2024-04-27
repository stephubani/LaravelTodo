

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
        @include('layouts.navigation')
        <div class ='row g-2 '>
            <div class='col-auto'>
                <h1>Roles</h1>
                <input type="text" class='form-control mb-3' name="roles" id="rolesname" placeholder='Roles-Name'>
                <input type="hidden" name="" id='roleid' value=''>
            </div>
        
            <div class='col-auto' style='margin-top:65px;'>
                <button type='submit' class='btn btn-warning' id='create'>Create</button>
            </div>
           
        </div>

        <div id='feedback' class='col-md-6'>
               
        </div>

        <div>
            <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>

                <tbody id='allroles'>
                    @foreach($roles as $role)
                        <tr id= '{{$role->id}}'>
                            <td class='rolesname'>{{$role->name}}</td>
                            <td>
                                <a href="/roles/{{$role->id}}/toggle">
                                    <button id= 'click' class='btn <?php echo $role->is_active ? "btn-warning" : "btn-secondary" ?>'>{{$role->displayLabel()}}</button>
                                </a>
                                
                            </td>
                            <td>
                                <button class='btn editbtn'id='editbtn{{$role->id}}' >
                                    <input type="hidden" name="" class='rolesid' value='{{$role->id}}'>
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button class='btn delete' id='delete_btn{{$role->id}}'>
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
                
            </thead>
                   
            </table>
        </div>

    </div>
<script src='/js/jquery.min.js'></script>
<script src='/js/roles.js'></script>
</body>
</html>