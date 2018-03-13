<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use App\http\Resources\Project as ProjectResource;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    
    public function __construct(){
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(15);

        return ProjectResource::collection($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*         $project = $request->isMethod('put') ? Project::findOrFail($request->project_id) : new Project;

        $project->id = $request->input('project_id');
        $project->title = $request->input('title');
        $project->content = $request->input('content');

        if($project->save()){
            return new ProjectResource($project);
        } */


        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];

        $this->validate($request, $rules);
        $newProject = Project::create($request->all());

        return new ProjectResource($newProject);

        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return new ProjectResource($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->fill($request->only([
            'title',
            'content',
        ]));

        if($project->isClean()){
            return response()->json(['error' => 'you need to specify a different value to update', 'code' =>409], 409);

        }
        
        $project->save();
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if($project->delete()){
            return new ProjectResource($project);

        }
    }
}
