@extends('layouts.master')


@section('content')

    <div class="bg-white" style="box-shadow: 0 0 5px 0 #dfdfdf;">
        <div class="py-3 px-4" style="box-shadow: 0 0 10px 0 #dfdfdf;">
            <strong>
                لیست ویدیوها
            </strong>
        </div>
        <div class="py-3 px-4">
            <div class="row mt-4">
                @foreach($videos as $v)
                <div class="col-md-4 mb-3">
                    <div class="p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc;">
                        <a href="/video/{{$v['id']}}/{{$v['title']}}" class="col-lg-3 col-md-6">
                            <div class="index-img pointer position-relative" style="background-image: url(/movie/{{$v['image']}})">
                                <i class="fas fa-play-circle position-absolute text-white text-center" style="font-size:50px;left: 0; right: 0; top: 35%"></i>
                            </div>
                            <h6 class="mt-3">{{$v['title']}}</h6>
                            <label class="font11" style="color:#ccc">چهارشنبه 9 تیر 1399</label>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
