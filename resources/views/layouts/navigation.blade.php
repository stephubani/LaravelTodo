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
                                    <a class="nav-link active redesigned" aria-current="page" href="{{ session('user_active') ? route('user.logout') :  route('userlogin') }}" style="font-size: 15px; color:white">
                                    {{ session('user_active') ? 'Logout' :  'LogIn' }}</a>
                                </li>

                        

                              




                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- navigation bar ends here -->

