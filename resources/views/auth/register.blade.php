@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="bg-white rounded p-5" style="box-shadow: 0 0 5px 0 #dfdfdf;">
            <h5 class="border-bottom pb-2 mb-5">ثبت نام در همگردی</h5>
            <div class="row justify-content-center">
                <div class="col-12">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-left">نام کاربری</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-left">نام و نام خانوادگی</label>
                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control"
                                   name="fullname" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-left">شماره موبایل شما</label>
                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control"
                                   name="mobile" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                               class="col-md-4 col-form-label text-left">ایمیل شما</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-left">رمز عبور</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label text-left">تکرار رمز عبور</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col-4"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">
                                ثبت نام
                            </button>
                        </div>
                    </div>

                    <div class="form-group font12 row mb-0">
                        <div class="col-4"></div>

                        <div class="col-md-6">
                            قبلا ثبت نام کرده اید؟
                            <a href="/login" class="border-bottom text-primary">وارد شوید</a>
                        </div>
                    </div>


                </form>
                </div>
            </div>

        </div>
    </div>
@endsection
