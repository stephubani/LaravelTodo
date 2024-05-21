@props([
    'type' => 'text',
    'name' => 'example_name', 
    'id' => 'example_id', 
    'placeholder' => 'Example Placeholder',
    'value'=> ''
])


<div class='col-auto'>
    <input type="{{$type}}" {{ $attributes->merge(['class' => 'form-control']) }} name="{{$name}}" id="{{$id}}" placeholder="{{$placeholder}}" value={{$value}}>
</div> 


