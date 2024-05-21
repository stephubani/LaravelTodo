@props([
    'id'=>'exampleid',
    'name'=>'examplename'
    ])


<div class="col-auto">
    <select name="{{$name}}" class='form-select' id="{{$id}}">
        <option value="">{{$default}}</option>
        {{$slot}}
    </select>
</div>
