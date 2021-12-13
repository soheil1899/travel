@extends('layouts.master')


@section('content')
    <div class="bg-white py-2 px-4 font12" style="box-shadow: 0 0 5px 0 #dfdfdf;border-radius: 5px;">
        <a href="/category/{{$place['category_id']}}/{{$place['category']['title']}}">{{$place['category']['title']}}</a>
        >
        {{$place['title']}}
    </div>

    <div class="px-md-5 px-2 my-4">
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
            <button class="btn btn-light border">
                <i class="fas fa-heart"></i>
                {{$place['like']}}
            </button>
            <a class="btn float-left btn-light border" target="_blank" href="https://telegram.me/share/url?url=https://hamgardi.com/fa/Place/2575-%d9%85%db%8c%d8%af%d8%a7%d9%86-%d9%86%d9%82%d8%b4-%d8%ac%d9%87%d8%a7%d9%86-%d8%a7%d9%85%d8%a7%d9%85-%d8%ae%d9%85%db%8c%d9%86%db%8c">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a class="btn float-left ml-2 btn-light border" target="_blank" href="https://twitter.com/intent/tweet?url=https://hamgardi.com/fa/Place/2575-%d9%85%db%8c%d8%af%d8%a7%d9%86-%d9%86%d9%82%d8%b4-%d8%ac%d9%87%d8%a7%d9%86-%d8%a7%d9%85%d8%a7%d9%85-%d8%ae%d9%85%db%8c%d9%86%db%8c">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="btn float-left ml-2 btn-light border" target="_blank" href="https://twitter.com/intent/tweet?url=https://hamgardi.com/fa/Place/2575-%d9%85%db%8c%d8%af%d8%a7%d9%86-%d9%86%d9%82%d8%b4-%d8%ac%d9%87%d8%a7%d9%86-%d8%a7%d9%85%d8%a7%d9%85-%d8%ae%d9%85%db%8c%d9%86%db%8c">
                <i class="fab fa-whatsapp font16"></i>
            </a>
        </div>


    </div>


    <div class="bg-white my-5" style="box-shadow: 0 0 5px 0 #dfdfdf;">
        <div class="p-4">
            <div class="pb-4">
                <h5 class="font16">لطفا با ثبت نظر خودتون در مورد این مکان به کاربران ما دید بهتری دهید</h5>
                <textarea class="form-control" rows="3" placeholder="نظر خودتان را بنویسید..."></textarea>
                <button class="btn btn-primary btn-sm px-5 float-left mt-2">ارسال نظر</button>
            </div>
        </div>
        <div class="p-4 bg-gray border-top border-bottom">
            135 نظر ثبت شده است
            <div class="float-left d-inline-block">
                <div class="form-check d-inline-block pl-5">
                    <input class="form-check-input" type="radio" style="margin: 5px -16px 0 0" name="exampleRadios" value="option1" checked>
                    <label class="form-check-label">
                        جدیدترین نظر
                    </label>
                </div>
                <div class="form-check d-inline-block">
                    <input class="form-check-input" type="radio" style="margin: 5px -16px 0 0" name="exampleRadios" value="option2">
                    <label class="form-check-label">
                        قدیمی ترین نظر
                    </label>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div class="rounded bg-comments p-4 mb-3" style="box-shadow: 0 0 4px 0 #dfdfdf;">
                <div>
                    <h6 class="widthfit d-inline-block mb-0">کاربر مهمان</h6>
                    <button class="btn btn-light btn-sm border float-left" style="margin-top: -5px">
                        <i class="fas fa-heart"></i>
                        5
                    </button>
                    <span class="float-left mx-3 font13 text-secondary">11 دی 1400</span>
                    <p class="mt-2 mb-0">
                        توضیحات: 1- دریافت اطلاعات واجب شامل ثالث و بدنه 2- بارگزاری تصاویر مربوط ... بقیه مراحل
                    </p>
                </div>
            </div>
            <div class="rounded bg-comments p-4 mb-3" style="box-shadow: 0 0 4px 0 #dfdfdf;">
                <div>
                    <h6 class="widthfit d-inline-block mb-0">کاربر مهمان</h6>
                    <button class="btn btn-light btn-sm border float-left" style="margin-top: -5px">
                        <i class="fas fa-heart"></i>
                        5
                    </button>
                    <span class="float-left mx-3 font13 text-secondary">11 دی 1400</span>
                    <p class="mt-2 mb-0">
                        توضیحات: 1- دریافت اطلاعات واجب شامل ثالث و بدنه 2- بارگزاری تصاویر مربوط ... بقیه مراحل
                    </p>
                </div>
            </div>
            <div class="rounded bg-comments p-4 mb-3" style="box-shadow: 0 0 4px 0 #dfdfdf;">
                <div>
                    <h6 class="widthfit d-inline-block mb-0">کاربر مهمان</h6>
                    <button class="btn btn-light btn-sm border float-left" style="margin-top: -5px">
                        <i class="fas fa-heart"></i>
                        5
                    </button>
                    <span class="float-left mx-3 font13 text-secondary">11 دی 1400</span>
                    <p class="mt-2 mb-0">
                        توضیحات: 1- دریافت اطلاعات واجب شامل ثالث و بدنه 2- بارگزاری تصاویر مربوط ... بقیه مراحل
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
