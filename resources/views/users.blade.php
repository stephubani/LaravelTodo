<x-template.markup>
    <x-template.headings-style h2="Users"/>
    
   

    <div class="row g-2">
        <x-template.inputs
            name='username'
            id="user"
            placeholder="User-Name"
        />

        <x-template.inputs
            type="hidden"
            name='userid'
            id="userid"
            placeholder="User"
        />

        <x-template.inputs
            type="email"
            name='useremail'
            id="useremail"
            placeholder="User-Email"
        />

        <x-template.select-style id="active_roles">
            <x-slot:default>Select A Role</x-slot>
            @foreach($active_roles as $roles)
                <option value="{{$roles->id}}">{{$roles->name}}</option>
            @endforeach
        </x-select-style>

        <x-template.button-style id="save">
            Create
        </x-template.button-style>
    </div>

    <div id='feedback'></div>


    <x-template.table-style id="user_details">
        <x-slot:thead>
            <th>User-Role</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Edit</th>
        </x-slot:thead>
        @foreach($users as $user)
        
            <tr id='{{$user->id}}'>
                <td class='rolename'>{{$user->role?->name}}</td>
                <td class='username'>{{$user->name}}</td>
                <td class='useremail'>{{$user->email}}</td>
                <td>
                    <a href="/users/{{$user->id}}/toggle">
                        <button id= 'click' class='btn <?php echo $user->is_active ? "btn-warning" : "btn-secondary" ?>'>{{$user->displayStatusOfUser()}}</button>
                    </a>
                    
                </td>
                <td>
                    <button class='btn editbtn'id='edit_btn{{$user->id}}' >
                        <input type="hidden" name="rolesid" class='role_id'value='{{$user->role?->id}}'>
                        <input type="hidden" name="userid" class='user_id' value='{{$user->id}}'>
                        <i class="fa-solid fa-pen"></i>
                    </button>


                    <button class='btn delete' id='delete_btn{{$user->id}}'>
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </x-template.table-style>
    <x-slot:js_path>
        {{'/js/user.js'}}
    </x-slot:js_path>
</x-template.markup>



      

   
  
