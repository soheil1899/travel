<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Place;
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

    public function place($id, $title)
    {
        $menu = Category::get(['id', 'title']);
        $place = Place::where('id', $id)->with('category')->first();

        return view('place', compact('menu', 'place'));
    }
}
