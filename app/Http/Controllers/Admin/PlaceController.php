<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class PlaceController extends Controller
{
    public function placeList()
    {
        return Place::with('category')->orderBy('id', 'desc')->paginate(10);
    }

    public function savePlace(Request $request)
    {
        $place = ($request->place['id']) ? Place::find($request->place['id']) : new Place();
        $place->title = $request->place['title'];
        $place->category_id = $request->place['category_id'];
        $place->flag = $request->place['flag'];
        $place->type = $request->place['type'];
        $place->tags = $request->place['tags'];
        $place->content = $request->place['content'];
        $place->address = $request->place['address'];
        $place->location = $request->place['location'];
        $place->save();

        if(!$request->place['id']){
            Storage::disk('public_p')->makeDirectory('place/' . $place['id']);
            Storage::disk('public_p')->makeDirectory('place/' . $place['id'] . '/small');
        }
    }

    public function deletePlace($id)
    {
        Place::destroy($id);
    }

    public function placeGallery($id)
    {
        return Image::where([['type', 'place'], ['type_id', $id]])->get();
    }

    public function savePlaceGallery(Request $request)
    {
        $rand = rand(100000, 999999);
        $path = '/place/'. $request->place_id . '/' . $rand . '.png';
        $path_small = '/place/'. $request->place_id . '/small/' . $rand . '.png';
        $image = new ImageManager();
        $image->make($request->image->getRealPath())->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path() . $path);
        $image->make($request->image->getRealPath())->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path() . $path_small);

        $placeImage = new Image();
        $placeImage->type_id = $request->place_id;
        $placeImage->type = 'place';
        $placeImage->address = $rand.'.png';
        $placeImage->save();

        $all_image = Image::where([['type', 'place'], ['type_id', $request->place_id]])->get();
        $base_image = Place::find($request->place_id);
        $base_image->image = $all_image[0]['address'];
        $base_image->save();

        return $placeImage;
    }

    public function deleteGallery(Request $request)
    {
        if ($request->file['type']=='place') {
            Storage::disk('public_p')->delete('/place/'. $request->file['type_id'] . '/' . $request->file['address']);
            Storage::disk('public_p')->delete('/place/'. $request->file['type_id'] . '/small/' . $request->file['address']);
        }
        Image::where('id', $request->file['id'])->delete();
    }
}
