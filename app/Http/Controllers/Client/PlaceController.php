<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    public function placeGallery($id)
    {
        return Image::where([['type', 'place'], ['type_id', $id]])->pluck('address');
    }

    public function placeLike($id, Request $request)
    {
        $like = Like::where([['type_id', $id], ['type', 'place'], ['ip_address', $request->ip()]])->first();
        if (!$like){
            $like = new Like();
            $like->type_id = $id;
            $like->type = 'place';
            $like->ip_address = $request->ip();
            $like->save();

            $place = Place::find($id);
            $place->like +=1;
            $place->save();

            return 'ADD';
        }
        return 'NOT';
    }

    public function commentLike($id, Request $request)
    {
        $like = Like::where([['type_id', $id], ['type', 'comment'], ['ip_address', $request->ip()]])->first();
        if (!$like){
            $like = new Like();
            $like->type_id = $id;
            $like->type = 'comment';
            $like->ip_address = $request->ip();
            $like->save();

            $comment = Comment::find($id);
            $comment->like +=1;
            $comment->save();

            return 'ADD';
        }
        return 'NOT';
    }

    public function getComment($id, Request $request)
    {
        $comments = Comment::where([['place_id', $id], ['publish', 1]])->with('user');
        if($request->ordering == 'new')
            return $comments->orderBy('id', 'desc')->get();
        return $comments->orderBy('id', 'asc')->get();

    }

    public function saveComment(Request $request)
    {
        $comment = new Comment();
        $comment->place_id = $request->place_id;
        if (Auth::check())
            $comment->user_id = \auth()->id();
        $comment->ip_address = $request->ip();
        $comment->comment = $request->comment;
        $comment->save();

    }
}
