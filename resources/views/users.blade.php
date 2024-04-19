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
                                    <a class="nav-link active redesigned" aria-current="page" href="login.php" style="font-size: 15px; color:white">
                                    Login</a>
                                </li>

                        

                              




                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- navigation bar ends here -->

    </div>
    
</body>
</html>