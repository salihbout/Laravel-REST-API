<?php

namespace App\Http\Controllers\Project;

use App\Project;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Resources\Category as CategoryResource;

class ProjectCategoryController extends Controller
{
    public function index(Project $project)
    {
        return CategoryResource::collection($project->categories);   
    }

    public function update(Request $request, Project $project, Category $category){

        $project->categories()->syncWithoutDetaching([$category->id]);

        return CategoryResource::collection($project->categories); 
    }

    public function destroy(Project $project, Category $category){
        if(!$project->categories->find($category->id)){
            return response()->json(['error' => 'The specified catgeory is not a category of this project', 'code' =>404], 404);
        }

        $project->categories()->detach($category->id);
        return CategoryResource::collection($project->categories); 
    }

}
