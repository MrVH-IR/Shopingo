@extends('customer.layouts.master-simple')
@section('head-tag')
    <title>ورود یا ثبت نام {{ config('app.app_persian_name') }}</title>
@endsection
@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{ route('auth.customer.login-confirm' , $token) }}" method="POST">
            @csrf
            <section class="login-wrapper mb-5">

                <section class="login-logo">
                    <img style="border-radius: 2rem; max-height: 10rem; max-width: 7rem;" src="{{ asset('admin-assets/images/shopingo_logo-3.png') }}" alt="Logo">
                </section>
                <section class="login-title mb-2"><a href="{{ route('auth.customer.login-register-form') }}"><i class="fa fa-arrow-alt-circle-right"></i></a></section>
                <section class="login-title">
                    لطفا کد تایید را وارد نمایید
                </section>
                <section class="login-info">کد ارسال شده به ایمیل یا شماره موباید خود را وارد کنید</section>
                <section class="login-input-text">
                    <input type="text"
                           name="code"
                           class="form-control @error('code') is-invalid @enderror"
                           placeholder="مثال: 1122334"
                           value="{{ old('code') }}">

                    @error('code')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </section>
                <section class="login-btn d-grid g-2"><button class="btn btn-danger" id="confirmBtn">تایید</button></section>
                <section>
                    <a href="#" class="text-decoration-none text-primary d-none" id="retryCode">دریافت مجدد کد تایید</a>
                </section>
                <div id="countdown"></div>
            </section>
        </form>
    </section>
@endsection

@section('script')
    <script>
        let duration = 5 * 60;

        const countdownEl = document.getElementById('countdown');
        const resendOtp   = document.getElementById('retryCode');
        const confirmBtn  = document.getElementById('confirmBtn');

        const timer = setInterval(() => {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            countdownEl.innerHTML = `${minutes}:${seconds}`;

            if (duration <= 0) {
                clearInterval(timer);

                countdownEl.innerHTML = '⛔ کد منقضی شد';

                confirmBtn.disabled = true;
                resendOtp.classList.remove('d-none');
            }

            duration--;
        }, 1000);
    </script>
@endsection
