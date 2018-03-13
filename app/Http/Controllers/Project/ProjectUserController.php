<?php

namespace App\Http\Controllers\Project;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Resources\User as UserResource;


class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $user = $project->user;
        return new UserResource($user);
    }
}
