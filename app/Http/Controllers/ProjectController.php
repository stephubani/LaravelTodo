<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log ;

class ProjectController extends Controller
{
    //
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService =$projectService;
    }

    public function index($project_id = null)
    {
        $projects = $this->projectService->show([]);
        $project = null;

        if ($project_id) {
            $project = $this->projectService->edit($project_id);
        }

        return view('project.index', compact('projects', 'project'));
    }

    public function create(ProjectRequest $request){
        $data = $request->validated();
        $this->projectService->create($data);

        return redirect()->back()->with('Successful');
    }

    public function edit($project_id){
        try{
            $project =  $project_id ? $this->projectService->edit($project_id, []) : false;
            return view('', compact('project'));
        }catch(Exception $e){
            Log::error('Failed to get projects',[
                'error'=> $e->getMessage(),
            ]);
        }
    }

    public function update(ProjectRequest $request){
        try{
            $project = Project::find($request->project_id);
            $this->projectService->update($request->validated() , $project);
            return redirect()->route('projects');
        }catch(Exception $e){
            Log::error('Failed', [
                'error'=> $e->getMessage()
            ]);
        }
    }

    public function delete($project_id){
        try{
            $project = Project::find($project_id);
            $this->projectService->delete($project);
            return redirect()->back()->with('Successful');
        }catch(Exception $e){
            Log::error('Failed', [
                'error'=> $e->getMessage()
            ]);
        }
    }
}
