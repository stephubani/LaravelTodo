@extends('layouts.markup')
<x-navigation/>

@section('content')
<form action="user/login" method='get'>
    @csrf
    <div class='row g-2'>
        <h4>Login</h4>
        <div class='col-auto'>
            <input type="email" class='form-control' name="email" id="" placeholder='Your Email'>
            <div>
                @if($errors->has('email'))
                    <p>{{ $errors->first('email')}}</p>
                @endif 
            </div>
        </div>
        <div class='col-auto'>
            <input type="password"  class='form-control' name="password" id="" placeholder = 'Your Password'>
            <div>
                @if($errors->has('password'))
                    <p>{{$errors->first('password')}}</p>
                @endif
            </div>
        </div>
        <div class='col-auto'>
            <button type="submit" class='btn btn-warning'>Login</button>
        </div>
    </div>

    <div>
        @if(session('error'))
        <p>{{session('error')}}</p>
        @endif
    </div>
</form>
@endsection

   
