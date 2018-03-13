<?php

namespace App\Http\Controllers\Project;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Resources\Comment as CommentResource;

class ProjectCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return CommentResource::collection($project->comments); 
    }

}
