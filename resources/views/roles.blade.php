<x-template.markup>
    <x-template.headings-style h2="Roles"/>
        
    <div class ='row g-2 '>
        @if (auth()->user()?->can('update', App\Models\Role::class))
            <x-template.inputs
                type="text"
                name='roles'
                id="rolesname"
                placeholder="Roles-Name"
            />
            <x-template.inputs
                type="hidden"
                name=''
                id="roleid"
                placeholder=""
            />
        
            <div class='col-auto'>
                <h5>Check All Permissions For The Role</h5>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="permissions" type="checkbox" value="{{$permission->id}}" id="{{$permission->name}}">
                        <label class="form-check-label" for="{{$permission->name}}">
                            {{$permission->name}}
                        </label>   
                    </div>
                @endforeach

            </div>
            <x-template.button-style id="create">
                Create
            </x-template.button-style>
        @endif
        
        
        
    </div>

    <div id='feedback'></div>

    <x-template.table-style id="allroles">
        <x-slot:thead>
             <tr>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
        </x-slot:thead>
            @foreach($roles as $role)
                <tr id= '{{$role->id}}'>
                    <td class='rolesname'>{{$role->name}}</td>
                    <td>
                        <ul>
                            @foreach($role->permissions as $permission)
                            <li>{{$permission->name}}</li>
                            <input type="hidden" name="permission_id" class='permission_id' value='{{$permission->id}}'>
                            @endforeach 
                        </ul>
                    </td>
                    <td>
                        <a href="/roles/{{$role->id}}/toggle">
                            <button id= 'click' class='btn <?php echo $role->is_active ? "btn-warning" : "btn-secondary" ?>'>{{$role->displayLabel()}}</button>
                        </a>
                        
                    </td>
                    <td>
                        <button class='btn editbtn'id='editbtn{{$role->id}}' >
                            <input type="hidden" name="" class='rolesid' value='{{$role->id}}'>
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <button class='btn delete' id='delete_btn{{$role->id}}'>
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </td>
                    
                </tr>
            @endforeach
    </x-template.table-style>
            
              
        
   
    <x-slot:js_path>
        {{'/js/roles.js'}}
    </x-slot:js_path>
</x-template.markup>

