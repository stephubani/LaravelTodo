@props([
    'id',
    'headings'
    ])
<div class='row'>
    <div class='col-md'>
        <table class='table table-striped'>
            <thead>
                <tr>
                    {{$thead}}
                </tr>
                
            </thead>
                
            <tbody id='{{$id}}'>
                {{$slot}}
            </tbody>
        </table>
    </div>
</div>
