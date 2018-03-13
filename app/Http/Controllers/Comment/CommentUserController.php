<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Resources\User as UserResource;

class CommentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $comment)
    {
        return new UserResource($comment->user);
    }

}
