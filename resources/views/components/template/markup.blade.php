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
    <div class="container-fluid">
        @include('layouts.navigation')
        {{$slot}}
    </div>
   
    <script src='/js/jquery.min.js'></script> 
    <script src='{{$js_path}}'></script> 
</body> 
</html>
