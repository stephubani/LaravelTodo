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
        <form action="user/login" method='get'>
            @csrf
            <div class='row g-2'>
                <h4>Login</h4>
                    <div class='col-auto'>
                        <input type="email" class='form-control' name="email" id="" placeholder='Your Email'>
                    </div>
                    <div class='col-auto'>
                        <input type="password"  class='form-control' name="password" id="" placeholder = 'Your Password'>
                    </div>

                    <div class='col-auto'>
                        <button type="submit" class='btn btn-warning'>Login</button>
                    </div>
            </div>
        </form>
    </div>
</body>
</html>