@extends('customer.layouts.master-simple')
@section('head-tag')
    <title>ورود یا ثبت نام {{ config('app.app_persian_name') }}</title>
@endsection
@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{ route('auth.customer.login-register') }}" method="POST">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img style="border-radius: 2rem; max-height: 10rem; max-width: 7rem;" src="{{ asset('admin-assets/images/shopingo_logo-3.png') }}" alt="Logo">
                </section>
                <section class="login-title">ورود / ثبت نام</section>
                <section class="login-info">شماره موبایل یا پست الکترونیک خود را وارد کنید</section>
                <section class="login-input-text">
                    <input type="text"
                           name="identify"
                           class="form-control @error('identify') is-invalid @enderror"
                           placeholder="مثال: 09121000000"
                           value="{{ old('identify') }}">

                    @error('identify')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </section>
                <section class="login-btn d-grid g-2"><button class="btn btn-danger">ورود به شاپینگو</button></section>
                <section class="login-terms-and-conditions"><a href="{{ url('/privacy-policy') }}">شرایط و قوانین</a> را خوانده ام و پذیرفته ام
                    <input class="form-check-input @error('confirmed') is-invalid @enderror" type="checkbox" value="confirmed" name="confirmed" id="flexCheckChecked">
                    @error('confirmed')
                    <li class="mt-5">
                        <span class="alert alert-danger">
                            {{ $message }}
                        </span>
                    </li>
                    @enderror
                </section>

            </section>
        </form>
    </section>
@endsection
