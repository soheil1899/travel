<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class MovieController extends Controller
{
    public function movieList()
    {
        return Movie::orderBy('id', 'desc')->paginate(6);
    }

    public function saveMovie(Request $request)
    {
        $movie = ($request->movie['id']) ? Movie::find($request->movie['id']) : new Movie();
        $movie->title = $request->movie['title'];
        $movie->aparat_link = $request->movie['aparat_link'];
        $movie->content = $request->movie['content'];
        $movie->tags = $request->movie['tags'];
        $movie->save();
    }

    public function deleteMovie($id)
    {
        Movie::destroy($id);
    }

    public function saveMovieImage(Request $request)
    {
        $movie = Movie::where('id', $request->movie_id)->first();
        if ($movie['image'])
            Storage::disk('public_p')->delete('/movie/'. $movie['image']);

        $rand = rand(100000, 999999);
        $path = '/movie/' . $rand . '.png';
        $image = new ImageManager();
        $image->make($request->image->getRealPath())->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path() . $path);

        $movieImage = new Image();
        $movieImage->type_id = $request->movie_id;
        $movieImage->type = 'movie';
        $movieImage->address = $rand.'.png';
        $movieImage->save();

        $movie->image = $movieImage['address'];
        $movie->save();
    }




}
