<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Seen;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $menu = Category::get(['id', 'title']);
        $place = Place::with('category')->orderBy('id', 'desc')->limit(12)->get();
        $video = Movie::orderBy('id', 'desc')->limit(4)->get();
        $random = Place::with('category')->inRandomOrder()->limit(3)->get();

        return view('welcome', compact('menu', 'place', 'video', 'random'));
    }

    public function category($id, $title)
    {
        $menu = Category::get(['id', 'title']);
        $category = Category::find($id);
        $place = Place::where('category_id', $id)->with('category')->orderBy('id', 'desc')->limit(8)->get();

        return view('category', compact('menu', 'category', 'place'));
    }

    public function videos()
    {
        $menu = Category::get(['id', 'title']);
        $videos = Movie::all();

        return view('videos', compact('menu', 'videos'));
    }

    public function video($id, $title)
    {
        $menu = Category::get(['id', 'title']);
        $video = Movie::where('id', $id)->first();

        return view('video', compact('menu', 'video'));
    }

    public function search()
    {
        $menu = Category::get(['id', 'title']);

        return view('search', compact('menu'));
    }

    public function place($id, $title, Request $request)
    {
        $menu = Category::get(['id', 'title']);
        $place = Place::where('id', $id)->with('category')->first();
        $seen = Seen::where([['place_id', $id], ['ip_address', $request->ip()]])->first();
        if (!$seen){
            $seen = new Seen();
            $seen->place_id = $id;
            $seen->ip_address = $request->ip();
            $seen->save();
            $place->seen +=1;
            $place->save();
        }

        return view('place', compact('menu', 'place'));
    }

    public function searching(Request $request)
    {
        $places = Place::where('title', 'like', "%$request->word%")
            ->orWhere('description', 'like', "%$request->word%")
            ->orWhere('content', 'like', "%$request->word%")
            ->orWhere('tags', 'like', "%$request->word%")
            ->orWhere('address', 'like', "%$request->word%")->with('category')->get();

        $videos = Movie::where('title', 'like', "%$request->word%")
            ->orWhere('content', 'like', "%$request->word%")->get();

        return ['places'=>$places, 'videos'=>$videos];
    }
}
