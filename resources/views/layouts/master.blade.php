<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <title>گردشگری شکوفه</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>


<body>


<div id="app">
<div class="container">
    <div class="row mx-0 my-3 px-5">
        <div class="col-6 pr-0 text-right">
            <a href="/">
            <img src="/images/logo.png" alt="">
            </a>
        </div>
        <div class="col-6 pl-0">
            @guest()
            <a href="/login" class="btn btn-primary text-white blue-shadow px-4">عضویت/ورود</a>
            @else
                @if(auth()->id()==1)
                <a href="/admin" class="btn btn-primary text-white blue-shadow px-4">پنل مدیریت</a>
                @endif
                    <a class="btn btn-dark text-white blue-shadow px-4" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        خروج
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            @endguest
            <a href="/search" class="btn btn-secondary2 px-4">
                <i class="fas fa-search"></i>
                جستجو
            </a>
        </div>
    </div>
    <div class="menu px-5">
        <ul class="text-right px-0 py-3">
            @foreach($menu as $m)
            <li><a href="/category/{{$m['id']}}/{{$m['title']}}">{{$m['title']}}</a></li>
            @endforeach
        </ul>
    </div>


    <div class="my-4 px-4">
        <div class="row mx-0 text-right">
            <div class="col-9 pr-0">
                @yield('content')
            </div>
            <div class="col-3 pl-0">
                <div class="bg-white mb-3 left-list rounded overflow-hidden">
                    <div class="bg-primary position-relative p-2">
                        <div class="position-absolute bg-warning py-2 px-3" style="top: 0; right: 0; height: 100%"><i
                                class="fas fa-bullhorn"></i></div>
                        <div class="bg-primary text-white pr-5"><h5 class="mb-0 font16">خرید آنلاین</h5></div>
                    </div>
                    <div class="p-1">
                        <ul class="list-unstyled px-1 mb-0">
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/تور-مشهد.jpg" alt="">
                                    تور مشهد</a></li>
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/تور-کیش.jpg" alt="">
                                    تور کیش</a></li>
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/اتوبوس.jpg" alt="">
                                    بلیط اتوبوس</a></li>
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/پرواز.jpg" alt="">
                                    بلیط هواپیما مشهد کیش</a></li>
                        </ul>
                    </div>
                </div>
                <div class="bg-white mb-3 left-list rounded overflow-hidden">
                    <div class="bg-primary position-relative p-2">
                        <div class="position-absolute bg-warning py-2 px-3" style="top: 0; right: 0; height: 100%"><i
                                class="fas fa-bullhorn"></i></div>
                        <div class="bg-primary text-white pr-5"><h5 class="mb-0 font16">خرید بلیط و تور</h5></div>
                    </div>
                    <div class="p-1">
                        <ul class="list-unstyled px-1 mb-0">
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/ترکیه.png" alt="">
                                    تور ترکیه</a></li>
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/مشهد-پرواز.png" alt="">
                                    بیلط هواپیما مشهد</a></li>
                            <li><a class="left-list-item rounded w-100 px-2 py-1 d-block mb-2 border" href="">
                                    <img class="ml-2" src="/images/آنتالیا.png" alt="">
                                    تور آنتالیا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="bg-white mb-3 left-list rounded overflow-hidden">
                    <div class="bg-primary position-relative p-2">
                        <div class="position-absolute bg-warning py-2 px-3" style="top: 0; right: 0; height: 100%"><i
                                class="fas fa-align-right"></i></div>
                        <div class="bg-primary text-white pr-5"><h5 class="mb-0 font16">رزرو هتل، اقامتگاه، ویلا و
                                سوییت</h5></div>
                    </div>
                    <div class="p-1">
                        <ul class="list-unstyled px-1 mb-0">
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    اجاره ویلا در کردان</a></li>
                            <li><a class="left-list-item2 bg-blue02 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    اقامتگاه بوم گردی</a></li>
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    اجاره ویلا</a></li>
                            <li><a class="left-list-item2 bg-blue02 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    اجاره آپارتمان مبله</a></li>
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    اجاره ویلا شمال</a></li>
                        </ul>
                    </div>
                </div>
                <div class="bg-white left-list rounded overflow-hidden">
                    <div class="bg-primary position-relative p-2">
                        <div class="position-absolute bg-warning py-2 px-3" style="top: 0; right: 0; height: 100%"><i
                                class="fas fa-align-right"></i></div>
                        <div class="bg-primary text-white pr-5"><h5 class="mb-0 font16">خرید بلیط تور و ویزا</h5></div>
                    </div>
                    <div class="p-1">
                        <ul class="list-unstyled px-1 mb-0">
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    تور قشم</a></li>
                            <li><a class="left-list-item2 bg-blue02 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    تور اروپا</a></li>
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    تور استانبول لحظه آخری</a></li>
                            <li><a class="left-list-item2 bg-blue02 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    بلیط هواپیما ارزان</a></li>
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    بلیط اتوبوس</a></li>
                            <li><a class="left-list-item2 bg-blue02 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    بلیط قطار</a></li>
                            <li><a class="left-list-item2 bg-blue01 text-center w-100 px-2 py-2 d-block rounded mb-2"
                                   href="">
                                    بلیط چارتر</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('additional')

    <div class="row mx-0 py-4 px-5" style="background-color: #f8902f">
        <div class="col-3 text-white pr-0 text-right">
            <h2 style="font-size: 20px; font-weight: bold">اشتراک در خبرنامه همگردی</h2>
        </div>
        <div class="col-6 text-white text-center">
            با عضویت در خبرنامه همگردی از تخفیف های ویژه، جشنواره های خرید، رویدادهای مهم دنیای سفر و گردشگری باخبر
            شوید.
        </div>
        <div class="col-3 pl-0">
            <div class="pr-5 position-relative">
                <input type="text" class="form-control text-left"
                       style="border-radius: 20px; padding: 0 35px; direction: ltr">
                <button class="btn btn-warning2 btn-sm position-absolute"
                        style="top: 5px;right: 0;border-radius: 15px;padding: 4px 20px;">اشتراک
                </button>
                <i class="fas fa-envelope position-absolute fa-lg" style="top: 10px;left: 10px;color: #f8902f;"></i>
            </div>
        </div>
    </div>

    <div class="row p-5 mx-0">
        <div class="col-6 pr-0">
            <h3 class="font16 text-right">درباره همگردی</h3>
            <div class="mb-3" style="width: 60px; height: 2px; background-color: #f8902f"></div>
            <p class="text-right font13">
                شرکت سامانه سفیران مهر همگردی با سایت همگردی؛ به عنوان اولین سایت گردشگری ایران با قابلیت های مشارکت
                کاربران خود، دارای اطلاعات جامع و کاملی در خصوص ایرانگردی و جهانگردی است. همگردی شامل اطلاعات جامعی در
                خصوص جاذبه های گردشگری ایران و جهان، راهنمای حرفه ای ایرانگردی و جهانگردی و اخبار و مقالات کاربردی حوزه
                گردشگری است. همگردی به شما این امکان را می دهد تا اوقات فراغت خود را برای یک برنامه گردشگری درون شهری یا
                برون شهری به خوبی برنامه ریزی کنید، برای سفر خود بلیط هواپیما، قطار یا اتوبوس تهیه کنید، هتل رزرو کنید و
                یک راهنمای سفر کاربردی داشته باشید. اطلاعات همگردی توسط گردشگران و مخاطبان سایت تهیه می شود و شما نیز
                این امکان را دارید تا به عنوان یک گردشگر حرفه ای یا غیر حرفه ای تجربیات، رویدادها و مکان های دیدنی شهر و
                مقاصد سفرتان را به دیگر گردشگران معرفی کنید و به گسترش فرهنگ گردشگری کمک کنید.
            </p>
        </div>
        <div class="col-3">
            <h3 class="font16 text-right">لینک های همگردی</h3>
            <div class="mb-3" style="width: 60px; height: 2px; background-color: #f8902f"></div>
            <div class="row text-right">
                <div class="col-6">
                    <ul class="pr-0" style="list-style: none;">
                        <li><a href="">قوانین</a></li>
                        <li><a href="">درباره ما</a></li>
                        <li><a href="">کسب و کار</a></li>
                        <li><a href="">فرصت های شغلی</a></li>
                        <li><a href="">تماس با ما</a></li>
                        <li><a href="">همکاری با ما</a></li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="pr-0" style="list-style: none">
                        <li><a href="">قوانین</a></li>
                        <li><a href="">درباره ما</a></li>
                        <li><a href="">کسب و کار</a></li>
                        <li><a href="">فرصت های شغلی</a></li>
                        <li><a href="">تماس با ما</a></li>
                        <li><a href="">همکاری با ما</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-3 pl-0">
            <h3 class="font16 text-right">همگردی را دنبال کنید</h3>
            <div class="mb-3" style="width: 60px; height: 2px; background-color: #f8902f"></div>
            <a href="" class="social-a" style="background-color: #5076ff; padding-left: 6px">
                <i class="fab fa-telegram item-social"></i>
            </a>
            <a href="" class="social-a" style="background-color: #ff50ac;">
                <i class="fab fa-instagram item-social"></i>
            </a>
        </div>
    </div>


</div>
</div>

</body>


</html>
