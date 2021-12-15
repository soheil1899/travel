@extends('layouts.master')


@section('content')
    <div class="bg-white py-2 px-4 font12" style="box-shadow: 0 0 5px 0 #dfdfdf;border-radius: 5px;">
        <a href="/category/{{$place['category_id']}}/{{$place['category']['title']}}">{{$place['category']['title']}}</a>
        >
        {{$place['title']}}
    </div>

    <div class="px-md-5 px-2 my-4 position-relative">
        <gallery :place_id="{{$place['id']}}"></gallery>
        <div class="px-md-5 px-3">
            <div class="page3-img" style="background-image: url(/place/{{$place['id']}}/{{$place['image']}})"></div>
        </div>
    </div>

    <div class="bg-white mt-3" style="box-shadow: 0 0 5px 0 #dfdfdf;">
        <div class="py-3 px-4" style="box-shadow: 0 0 10px 0 #dfdfdf;">
            <strong>
                درباره
                {{$place['title']}}
            </strong>
            <div class="d-inline-block font13 float-left">
                <i class="far fa-eye"></i>
                {{$place['seen']}}
                بازدید
            </div>
        </div>
        <div class="py-3 px-4">
            <p>{!! $place['content'] !!}</p>


            <div class="location my-4">
            {!! $place['location'] !!}
            </div>

            <div>
                @foreach(explode('/', $place['tags']) as $tag)
                <span class="border rounded font11 pointer p-1 ml-1"># {{$tag}}</span>
                @endforeach
            </div>
        </div>
        <div class="py-3 px-4" style="box-shadow: 0 0 10px 0 #dfdfdf;">
            <place-like :place_id="{{$place['id']}}" :like="{{$place['like']}}"></place-like>


            <a class="btn float-left btn-light border" target="_blank" href="https://telegram.me/share/url?url=http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a class="btn float-left ml-2 btn-light border" target="_blank" href="https://twitter.com/intent/tweet?url=http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="btn float-left ml-2 btn-light border" target="_blank" href="https://web.whatsapp.com/send?text=http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}">
                <i class="fab fa-whatsapp font16"></i>
            </a>
        </div>


    </div>




    <comment :place_id="{{$place['id']}}"></comment>

@endsection
