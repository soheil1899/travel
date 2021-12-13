@extends('layouts.master')

@section('content')
<div class="container">
    <div class="bg-white rounded p-5" style="box-shadow: 0 0 5px 0 #dfdfdf;">
        <h5 class="border-bottom pb-2 mb-5">ورود به همگردی</h5>
    <div class="row justify-content-center">
        <div class="col-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-left">آدرس ایمیل شما:</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-left">رمز ورود شما:</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-4"></div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label mr-4" for="remember">
                                مرا به خاطر بسپار
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-4"></div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">
                            ورود
                        </button>
                    </div>
                </div>

                <div class="form-group font12 row mb-0">
                    <div class="col-4"></div>

                    <div class="col-md-6">
                        تاکنون ثبت نام نکرده اید؟
                        <a href="/register" class="border-bottom text-primary">ثبت نام کنید</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
