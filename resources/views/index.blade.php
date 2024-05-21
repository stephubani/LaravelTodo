<x-template.markup>
    <x-template.headings-style h2="Todo"/>
        <form action="{{!isset($todo) ? '/todo/create' : '/todo/edit'}}" method='{{!isset($todo) ? "post" : "get"}}'>
        @csrf
        <div class='row g-2'>
            @if(session('success'))
                <p class='text-secondary'>{{session('success')}}</p>
            @endif

            <x-template.inputs 
                name="todoname"
                id=""
                placeholder="Todo-Name"
                value="{{isset($todo) ? $todo->name : ''}}"
            />

            <x-template.inputs 
                type="hidden"
                placeholder="Todoid"
                name="todo_id"
                id=""
                value="{{isset($todo) ? $todo->id : ''}}"
            />
        
            <x-template.select-style name="activeuser">
                <x-slot:default>Select A User</x-slot>
                @foreach($active_users as $user)
                    <option value="{{$user->id}}" {{isset($todo) && $todo->user->id == $user->id ?  'selected' : ""}}>{{$user->name}}</option>
                @endforeach
            </x-select-style>
        
                <div>
                    @if ($errors->has('activeuser'))
                        <p class='text-secondary'>{{$errors->first('activeuser')}}</p>
                    @endif
                </div>
            <x-template.button-style id='create' type="submit">
                {{!isset($todo)? 'Create': 'Edit'}}
            </x-template.button-style>

            <div class="col-auto">
                @if(isset($todo))
                    <a href="/" class='btn btn-warning'>Cancel</a>
                @endif  
            </div>
        </div>

        <div>
            @if ($errors->has('todoname'))
                <p class='text-secondary'>{{$errors->first('todoname')}}</p>
            @endif
        </div>

        
        
    </form>
    <x-template.table-style id="todo">
        <x-slot:thead>
            <th>User</th>
            <th>Todo-Name</th>
            
        </x-slot:thead>
      
        @foreach($todos as $todo)
            <tr>
                <td>{{$todo->user?->name}}</td>
                <td>{{$todo->name}}</td>
                <td>
                    <a href="todo/{{$todo->id}}/completeTodo">
                        <button class='btn {{$todo->is_completed ? "btn-warning" : "btn-secondary"}}'>
                            {{$todo->displayStatus()}}
                        </button>
                    </a>
                </td>
                <td>{{$todo->updated_at}}</td>
                <td>
                    @if(!$todo->is_completed)
                        <a href="/todo/{{$todo->id}}/fetch">
                            <button class='btn editbtn'id='edit_btn' >
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </a>
                    @endif
                    <a href="/todo/{{$todo->id}}/delete">
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



