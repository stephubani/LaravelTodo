<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Todo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ProjectService
{
   public function create(array $data):bool
   {
        try{
            Project::create($data);
        }catch(Exception $e){
            Log::error('Failed to create a project', [
                'error'=> $e->getMessage(),
                'data'=> $data
            ]);
            return false;
        }

        return true;
   }

   public function edit(int $project_id,?array $relationships = null):?Project
   {


            $query = Project::query();
            if($relationships){
                $query->with($relationships);
            }
            return $query->find($project_id);



   }

   public function update(array $data, Project $project):bool
   {

        try{
            $project->update($data);
        }catch(Exception $e){
            Log::error('Failed to update project', [
                'error'=> $e->getMessage(),
                'data'=> $data,
            ]);
            return false;
        }

        return true;
   }

   public function show(?array $relationships = null):Collection
   {
       try {
           $query = Project::query();
           if (!empty($relationships)) {
               $query->with($relationships);
           }
           return $query->get();
       } catch (Exception $e) {
           Log::error('Failed to fetch projects', [
               'error' => $e->getMessage(),
           ]);

           return collect();
       }
   }

   public function delete(Project $project):bool
   {
        try{
            $project->delete();

        }catch(Exception $e){
            Log::error('Failed', [
                'error'=> $e->getMessage()
            ]);
            return false;
        }

        return true;
   }
}
