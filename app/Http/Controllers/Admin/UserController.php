<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userList()
    {
        return User::orderBy('id', 'desc')->paginate(10);
    }

    public function saveUser(Request $request)
    {
        if ($request->user['id'] == null) {
            if($request->user['mobile'] != 'null' && $request->user['mobile'] != null && User::where('mobile', $request->user['mobile'])->exists())
                return response(['msg' => 'این شماره موبایل قبلا در سیستم ثبت شده است', 'status' => 500], 500);
            if($request->user['email'] != 'null' && $request->user['email'] != null && User::where('email', $request->user['email'])->exists())
                return response(['msg' => 'این آدرس ایمیل قبلا در سیستم ثبت شده است', 'status' => 500], 500);
            if($request->user['name'] != 'null' && $request->user['name'] != null && User::where('name', $request->user['name'])->exists())
                return response(['msg' => 'این نام کاربری قبلا در سیستم ثبت شده است', 'status' => 500], 500);
            $user = new User();
        } else {
            $user = User::where('id', $request->user['id'])->first();
            if($request->user['mobile'] != 'null' && $request->user['mobile'] != null && User::where([['mobile', $request->user['mobile']], ['id', '<>', $user->id]])->exists())
                return response(['msg' => 'این شماره موبایل قبلا در سیستم ثبت شده است', 'status' => 500], 500);
            if($request->user['email'] != 'null' && $request->user['email'] != null && User::where([['email', $request->user['email']], ['id', '<>', $user->id]])->exists())
                return response(['msg' => 'این آدرس ایمیل قبلا در سیستم ثبت شده است', 'status' => 500], 500);
            if($request->user['name'] != 'null' && $request->user['name'] != null && User::where([['name', $request->user['name']], ['id', '<>', $user->id]])->exists())
                return response(['msg' => 'این نام کاربری قبلا در سیستم ثبت شده است', 'status' => 500], 500);
        }

        $user->name = $request->user['name'];
        $user->fullname = $request->user['fullname'];
        $user->mobile = $request->user['mobile'];
        $user->email = $request->user['email'];


        if ($request->user['password'] && strlen($request->user['password']) > 3 && ($request->user['password'] == $request->user['confirm_password']))
            $user->password = Hash::make($request->user['password']);
        $user->save();

    }

    public function deleteUser($id)
    {
        User::destroy($id);
    }
}
