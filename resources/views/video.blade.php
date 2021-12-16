@extends('layouts.master')


@section('content')
    <div class="bg-white py-2 px-4 font12" style="box-shadow: 0 0 5px 0 #dfdfdf;border-radius: 5px;">
        <a href="/videos">لیست ویدیوها</a>
        >
        {{$video['title']}}
    </div>

    <div class="px-md-5 px-2 my-4 position-relative">
        <div class="px-md-5 px-3">
            <div id="{{$video['id']}}"><script type="text/JavaScript" :src="'https://www.aparat.com/embed/{{$video['aparat_link']}}?data[rnddiv]={{$video['id']}}&data[responsive]=yes'"></script></div>
        </div>
    </div>

    <div class="bg-white mt-3" style="box-shadow: 0 0 5px 0 #dfdfdf;">
        <div class="py-3 px-4" style="box-shadow: 0 0 10px 0 #dfdfdf;">
            <h5 class="d-inline-block">
                {{$video['title']}}
            </h5>
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
        <div class="py-3 px-4">
            <p>{!! $video['content'] !!}</p>

            <div>
                @foreach(explode('/', $video['tags']) as $tag)
                <span class="border rounded font11 pointer p-1 ml-1"># {{$tag}}</span>
                @endforeach
            </div>
        </div>


    </div>


@endsection
