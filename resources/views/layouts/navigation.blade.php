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
                              @can('viewTodo', App\Models\User::class)
                                <li class="nav-item">
                                    <a class="nav-link active redesigned" aria-current="page" href="{{route('index')}}" style="font-size: 15px; color:white">Home</a>
                                </li>
                              @endcan
                                    
                               
                            
                                @can('viewUser', App\Models\User::class)
                                    <li class="nav-item">
                                        <a class="nav-link active redesigned" aria-current="page" href="{{route('users')}}" style="font-size: 15px; color:white">Users</a>
                                    </li>
                                @endcan

                                @can('viewRole', App\Models\User::class) 
                                    <li class="nav-item">
                                        <a class="nav-link active redesigned" aria-current="page" href="{{route('roles')}}" style="font-size: 15px; color:white">
                                        Roles
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item pad">
                                    <a class="nav-link active redesigned" aria-current="page" href="{{route('permissions')}}" style="font-size: 15px; color:white">
                                    Permissions</a>
                                </li>


                               

                            </ul>

                            <div class="text-light">Hello {{auth()->user()?->name}}</div>

                            <div class="nav-item pad p-3">
                                @if(!auth()->check())
                                <a class="nav-link active redesigned btn btn-outline-warning" aria-current="page" href="{{ route('login') }}" style="font-size: 15px; color:white">
                                Login</a>
                                @else
                                    <form action="{{route('logout')}}" method='post'>
                                    @csrf
                                        <button class="btn btn-outline-warning" type='submit'>LogOut</button>
                                    </form>
                                @endif
                            </div>

                           
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- navigation bar ends here -->