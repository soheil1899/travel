<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function getSetting()
    {
        return Setting::first();
    }

    public function changeSetting(Request $request)
    {
        $req_setting = json_decode($request->setting, true);
        $setting = Setting::find(1);
        $setting->title = $req_setting['title'];
        $setting->description = $req_setting['description'];
        $setting->keywords = $req_setting['keywords'];
        $setting->site_name = $req_setting['site_name'];
        $setting->tell = $req_setting['tell'];
        $setting->mobile = $req_setting['mobile'];
        $setting->address = $req_setting['address'];
        $setting->telegram = $req_setting['telegram'];
        $setting->instagram = $req_setting['instagram'];
        $setting->linkedin = $req_setting['linkedin'];
        $setting->aparat = $req_setting['aparat'];
        $setting->about = $req_setting['about'];

        if ($request->image!='undefined'){
            $image = new ImageManager();
            $image->make($request->image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path() . '/logo.png');
            $setting->site_logo = 1;
        }
        $setting->save();
    }
}
