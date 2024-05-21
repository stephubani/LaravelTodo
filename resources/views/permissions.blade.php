<x-template.markup>
    <x-template.headings-style h2="Permissions"/>

    <form action="{{!isset($a_permission)? '/permissions/create ': '/permissions/edit'}}" method='get'>
        <div class ='row g-2 '>
            <x-template.inputs 
                placeholder="Permission-Name"
                name="permission"
                id="permissions"
                value="{{isset($a_permission)? $a_permission->name: ''}}"
            />
           

            <x-template.inputs 
                type="hidden"
                placeholder="Permission-Name"
                name="permission_id"
                id="permissions"
                value="{{isset($a_permission)? $a_permission->id: ''}}"
            />

            <div class='col-auto'>
                <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea" name='description'>{{isset($a_permission )?  $a_permission->description: ''}}</textarea>
                    <label for="floatingTextarea">Description</label>
                    @if($errors->has('description'))
                        <p>{{$errors->first('description')}}</p>
                    @endif
                </div>
            </div>
           
            <x-template.button-style id='create' type="submit">
                {{!isset($a_permission)? 'Create ': 'Edit'}}
            </x-template.button-style>
            <div class="col-auto">
               @if(isset($a_permission))
                    <a href="/permissions" class='btn btn-warning'>Cancel</a>   
                @endif
            </div>
            
        </div>

        <div>
            @if($errors->has('permission'))
                <p>{{$errors->first('permission')}}</p>
            @endif  
        </div>
    </form>
    @if(session('success'))
    <div id='feedback' class='col-md-6'>
            <p>{{session('success')}}</p>
    </div>
    @endif
   

        <x-template.table-style id="permissions">
            <x-slot:thead>
                <th>Name</th>
                <th>Description</th>
                <th>Edit/Delete</th>
            </x-slot:thead>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                    <td>
                        <a href="/permissions/{{$permission->id}}/show">
                            <button class='btn editbtn'id='edit_btn' >
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </a>
                        
                        <a href="/permisions/{{$permission->id}}/delete">
                            <button class='btn delete' id='delete_btn'>
                                <i class="fa-solid fa-trash text-danger"></i>
                            </button>
                        </a>
                        
                    </td>
                </tr>
            @endforeach
        </x-template.table-style>
            
    <x-slot:js_path>
        {{'#'}}
    </x-slot:js_path>
</x-template.markup>




