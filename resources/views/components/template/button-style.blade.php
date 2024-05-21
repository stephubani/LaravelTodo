@props([
    'id',
    'type'=>'button'
    
    ])
<div class='col-auto'>
    <button type="{{$type}}" {{$attributes->merge(['class'=>'btn btn-warning'])}} id='{{$id}}'>{{$slot}}</button>
</div>