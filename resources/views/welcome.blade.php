@extends('layouts.master')


@section('content')
    <div class="row mx-0">
        @foreach($place as $p)
        <div class="col-lg-4 mb-4">
            <div class="p-2" style="box-shadow: 0 0 10px 0 #ccc;">
                <a href="/place/{{$p['id']}}/{{$p['title']}}">
                    <div class="index-img" style="background-image: url(/place/{{$p['id']}}/{{$p['image']}})"></div>
                    <div class="row border-bottom mx-0 py-2">
                        <div class="col-2 text-center" style="padding: 8px;border-radius: 30px;background-color: #30a1ff;">
                            @if($p['type']=='جاذبه طبیعت')
                            <i class="fas fa-tree text-white" style="font-size: 30px"></i>
                            @elseif($p['type']=='مکان قدیمی')
                                <i class="fas fa-landmark text-white" style="font-size: 30px"></i>
                            @elseif($p['type']=='مکان مدرن')
                                <i class="fas fa-gopuram text-white" style="font-size: 30px"></i>
                            @else
                                <i class="fas fa-utensils text-white" style="font-size: 30px"></i>
                            @endif
                        </div>
                        <div class="col-10 pt-2">
                            <h5 class="font-weight-bold font15">{{$p['title']}}</h5>
                            <h6 class="text-primary font13 mb-0">{{$p['type']}}</h6>
                        </div>
                    </div>
                    <div class="text-left font13 mt-2">
                        <label class="text-secondary mr-4 mb-0">
                            {{$p['like']}}
                            <i class="fas fa-heart"></i>
                        </label>
                        <label class="text-secondary mr-4 mb-0">
                            {{$p['seen']}}
                            <i class="far fa-eye"></i>
                        </label>
                    </div>
                </a>
            </div>
        </div>
        @endforeach

    </div>
@endsection







@section('additional')

    <div class="index-video text-white my-5 py-4 px-5" style="background-color: #424242">
        <div class="row mx-0">
            <div class="col-6 text-right">
                <h5>آخرین ویدیوها</h5>
            </div>
            <div class="col-6">
                <a href="/videos" class="text-primary">نمایش بیشتر
                    <i class="fas fa-chevron-circle-left"></i>
                </a>
            </div>
        </div>
        <div class="row mx-0 text-right mt-4">
            @foreach($video as $v)
            <a href="/video/{{$v['id']}}/{{$v['title']}}" class="col-lg-3 col-md-6">
                <div class="index-img pointer position-relative" style="background-image: url(/movie/{{$v['image']}})">
                    <i class="fas fa-play-circle position-absolute text-white text-center" style="font-size:50px;left: 0; right: 0; top: 35%"></i>
                </div>
                <h6 class="mt-3 text-white">{{$v['title']}}</h6>
                <label class="font11" style="color:#ccc">چهارشنبه 9 تیر 1399</label>
            </a>
            @endforeach

        </div>
    </div>


    <div class="resturan my-5 py-4  mx-5">
        <div>
            <h5 style="border-bottom: 3px solid #56a0d9" class="widthfit pb-2 mx-auto px-3">پیشنهادهای لحظه ای همگردی</h5>
        </div>
        <div class="row mx-lg-5 mt-4 px-lg-5">
            @foreach($random as $r)
            <div class="col-lg-4 mb-lg-0 mb-5">
                <a href="/place/{{$r['id']}}/{{$r['title']}}">
                <div class="index-img pointer position-relative" style="background-image: url(/place/{{$r['id']}}/{{$r['image']}})">
                    <div class="position-absolute bg-white mx-auto p-3 font12 text-center" style="border-radius: 10px;box-shadow: 0 0 10px 0 #bfbfbf;left: 0; right: 0; top: 120px; width: 90%">
                        {{$r['flag']}}
                        <div class="position-absolute widthfit px-3 py-1 mx-auto" style="background-color: #a8d6ff;top: -15px; left: 0; right: 0; border-radius: 5px">
                            {{$r['title']}}
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection



