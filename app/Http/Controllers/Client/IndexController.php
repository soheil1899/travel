<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Seen;
use App\Models\Setting;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $menu = Category::get(['id', 'title']);
        $setting = Setting::first();
        $place = Place::with('category')->orderBy('id', 'desc')->limit(12)->get();
        $video = Movie::orderBy('id', 'desc')->limit(4)->get();
        $random = Place::with('category')->inRandomOrder()->limit(3)->get();

        return view('welcome', compact('menu', 'place', 'video', 'random', 'setting'));
    }

    public function category($id, $title)
    {
        $menu = Category::get(['id', 'title']);
        $setting = Setting::first();
        $category = Category::find($id);
        $place = Place::where('category_id', $id)->with('category')->orderBy('id', 'desc')->limit(8)->get();

        return view('category', compact('menu', 'category', 'place', 'setting'));
    }

    public function videos()
    {
        $menu = Category::get(['id', 'title']);
        $setting = Setting::first();
        $videos = Movie::all();

        return view('videos', compact('menu', 'videos', 'setting'));
    }

    public function video($id, $title)
    {
        $menu = Category::get(['id', 'title']);
        $setting = Setting::first();
        $video = Movie::where('id', $id)->first();

        return view('video', compact('menu', 'video', 'setting'));
    }

    public function search()
    {
        $menu = Category::get(['id', 'title']);
        $setting = Setting::first();

        return view('search', compact('menu', 'setting'));
    }

    public function place($id, $title, Request $request)
    {
        $menu = Category::get(['id', 'title']);
        $setting = Setting::first();
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

        return view('place', compact('menu', 'place', 'setting'));
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
