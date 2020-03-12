<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $request->validate([
            'body1'=>'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        $comment = new Comment();
        $comment->body = $request->input('body1');
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->parent_id = $request->input('parent_id');

        $comment->save();

        return back();
    }
}
