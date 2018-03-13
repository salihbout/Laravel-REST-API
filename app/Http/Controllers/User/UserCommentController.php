<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Resources\Comment as CommentResource;

class UserCommentController extends Controller
{
    
    public function index(User $user)
    {
        return CommentResource::collection($user->comments); 
    }

   
}
