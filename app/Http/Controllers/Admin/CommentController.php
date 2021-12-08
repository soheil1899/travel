<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentList()
    {
        return Comment::orderBy('id', 'desc')->with('user', 'place')->paginate(10);
    }

    public function deleteComment($id)
    {
        Comment::destroy($id);
    }

    public function changeCommentPublish($id, $publish)
    {
        Comment::where('id', $id)->update(['publish'=>$publish]);
    }

    public function changeCommentContent(Request $request)
    {
        Comment::where('id', $request->id)->update(['comment'=>$request->comment]);
    }
}
