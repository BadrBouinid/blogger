<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentsController extends Controller
{


    public function store(Request $request)
    {
        $comment=new Comment();
        $comment->body=$request->body;
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$request->post_id;
        $comment->save();
        return redirect()->back();
    }

}
