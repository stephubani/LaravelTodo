<x-template.markup>
    <x-template.headings-style h2="Project"/>
    <form action="{{ !isset($project) ? '/project/create' : '/project/update' }}" method="post">
        @if(isset($project))
            @method('PUT')
        @endif
        @csrf
        <div class="space-y-4">
            @if(session('success'))
                <p class="text-green-600">{{ session('success') }}</p>
            @endif

            <x-template.inputs
                name="name"
                placeholder="project-Name"
                value="{{ isset($project) ? $project->name : '' }}"
            />

            <x-template.inputs
                type="hidden"
                name="project_id"
                value="{{ isset($project) ? $project->id : '' }}"
            />
            <x-template.button-style class="mt-4" id="create" type="submit">
                {{ !isset($project) ? 'Create' : 'Edit' }}
            </x-template.button-style>

            @if(isset($project))
                <a href="/project" class="inline-block btn btn-warning ml-2">Cancel</a>
            @endif

            @if ($errors->has('name'))
                <p class="text-red-500 text-sm">{{ $errors->first('name') }}</p>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <div id="project-list" class="grid grid-cols-1 gap-4">
        @foreach($projects as $project)
            <div class="bg-white border p-4 rounded shadow-md flex justify-between items-center" data-id="{{ $project->id }}">
                <div>

                    <p class="font-semibold">{{ $project->name }}</p>
                    <br>
                    <small class="text-gray-400">{{ $project->updated_at }}</small>
                </div>
                <div class="flex gap-2 items-center">

                    <a href="/project/{{ $project->id }}/fetch">
                        <button class="btn editbtn" id="edit_btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </a>

                    <a href="/project/{{ $project->id }}/delete">
                        <button class="btn delete" id="delete_btn">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <x-slot:js_path>
        {{'/js/sortable-project.js'}}
    </x-slot:js_path>
</x-template.markup>



