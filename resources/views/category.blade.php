@extends('layouts.master')


@section('content')

    <div class="bg-white" style="box-shadow: 0 0 5px 0 #dfdfdf;">
        <div class="py-3 px-4" style="box-shadow: 0 0 10px 0 #dfdfdf;">
            <strong>
                {{$category['title']}}
            </strong>
        </div>
        <div class="py-3 px-4">
            @foreach($place as $p)
            <a href="/place/{{$p['id']}}/{{$p['title']}}" class="row border rounded mb-3 p-3">
                <div class="col-lg-4 pr-0">
                    <div class="page2-img" style="background-image: url(/place/{{$p['id']}}/{{$p['image']}})"></div>
                </div>
                <div class="col-lg-8 py-2 pl-0">
                    <h2 class="text-primary font16">{{$p['title']}}</h2>
                    <p><i class="fas fa-map-marker-alt text-primary font16"></i>
                        {{$p['address']}}</p>
                    <p class="mb-0">
                        {{$p['description']}}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
