<x-template.markup>
    <x-template.headings-style h2="Todo"/>
    <form action="{{ !isset($todo) ? '/todo/create' : '/todo/edit' }}" method="{{ !isset($todo) ? 'post' : 'get' }}">
        @csrf

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Project Selection -->
            <div class="col-md-4 mb-3">
                <x-template.select-style name="project_id">
                    <x-slot:default>Assign Project</x-slot>
                    @foreach($projects as $project)
                        <option
                            value="{{ $project->id }}"
                            {{ isset($todo) && $todo->project->id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </x-template.select-style>

                @if ($errors->has('project_id'))
                    <p class="text-danger text-sm">{{ $errors->first('project_id') }}</p>
                @endif
            </div>

            <!-- Todo Name -->
            <div class="col-md-4 mb-3">
                <x-template.inputs
                    name="todoname"
                    placeholder="Task Name"
                    value="{{ isset($todo) ? $todo->name : '' }}"
                />
                @if ($errors->has('todoname'))
                    <p class="text-danger text-sm">{{ $errors->first('todoname') }}</p>
                @endif
            </div>

            <!-- Hidden Todo ID -->
            <div class="d-none">
                <x-template.inputs
                    type="hidden"
                    name="todo_id"
                    value="{{ isset($todo) ? $todo->id : '' }}"
                />
            </div>

            <!-- User Selection -->
            <div class="col-md-4 mb-3">
                <x-template.select-style name="activeuser">
                    <x-slot:default>Select A User</x-slot>
                    @foreach($active_users as $user)
                        <option
                            value="{{ $user->id }}"
                            {{ isset($todo) && $todo->user->id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </x-template.select-style>
                @if ($errors->has('activeuser'))
                    <p class="text-danger text-sm">{{ $errors->first('activeuser') }}</p>
                @endif
            </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="mt-4">
            <x-template.button-style id="create" type="submit">
                {{ !isset($todo) ? 'Create' : 'Edit' }}
            </x-template.button-style>

            @if(isset($todo))
                <a href="/" class="btn btn-warning ml-2">Cancel</a>
            @endif
        </div>
    </form>


    <hr class="my-6">

    <div class="flex gap-6 overflow-x-auto" id="trello-board">
        <div class="min-w-[300px] bg-gray-100 p-4 rounded shadow flex-1">
            <h2 class="font-bold text-xl mb-4">My Tasks</h2>

            <div class="row" id="todo-column">
                @foreach($todos as $todo)
                    <!-- Task Card -->
                    <div class="col-md-6 col-lg-4 mb-5" data-id="{{ $todo->id }}">
                        <div class="bg-white p-5 rounded-lg shadow-lg border hover:shadow-xl transition-shadow duration-300">
                            <!-- Priority Badge -->
                            <div class="flex justify-between items-center mb-4">
                                <h1 class="text-lg font-bold
                                    {{ $todo->priority == 1 ? 'text-red-600' :
                                    ($todo->priority == 2 ? 'text-yellow-500' : 'text-green-500') }}">
                                    Priority #{{ $todo->priority }}
                                </h1>
                            </div>

                            <!-- Task Details -->
                            <div class="mb-4">
                                <h5 class="text-xl font-semibold text-gray-800">Project: <span class="font-medium text-gray-600">{{ $todo->project->name }}</span></h5>
                                <h6 class="text-lg font-semibold text-gray-700">Task :{{ $todo->name }}</h6>
                                <div class="text-sm text-gray-500 mt-2">
                                    <p>Assigned to: <span class="font-medium text-gray-600">{{ $todo->user?->name }}</span></p>
                                    <p>Last Updated: <span class="text-gray-400">{{ $todo->updated_at->format('M d, Y - H:i') }}</span></p>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-3 mt-4">
                                <a href="/todo/{{ $todo->id }}/completeTodo">
                                    <button class="btn btn-{{ $todo->is_completed ? 'warning' : 'primary' }} w-full py-2 text-white font-semibold rounded-lg shadow-sm transition duration-200 hover:bg-opacity-90">
                                        {{ $todo->displayStatus() }}
                                    </button>
                                </a>
                                @if(!$todo->is_completed)
                                    <a href="/todo/{{ $todo->id }}/fetch">
                                        <button class="btn btn-secondary w-full py-2 text-white font-semibold rounded-lg shadow-sm transition duration-200 hover:bg-opacity-90">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </button>
                                    </a>
                                @endif
                                <a href="/todo/{{ $todo->id }}/delete">
                                    <button class="btn btn-danger w-full py-2 text-white font-semibold rounded-lg shadow-sm transition duration-200 hover:bg-opacity-90">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <x-slot:js_path>
        {{'/js/sortable-todo.js'}}
    </x-slot:js_path>
</x-template.markup>



