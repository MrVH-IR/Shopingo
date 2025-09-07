@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد کاربر ادمین</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="#">بخش کاربران</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.market.property.index') }}">کاربران ادمین</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
           ایجاد کاربر ادمین
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
           ایجاد کاربر ادمین
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="h6">نام</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="{{ old('first_name') }}">
                                </div>
                                @error('first_name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="h6">نام خانوادگی</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="{{ old('last_name') }}">
                                </div>
                                @error('last_name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email" class="h6">ایمیل</label>
                                        <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="mobile" class="h6">شماره موبایل</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" value="{{ old('mobile') }}">
                                        <p class="mobile-error" style="color: red; font-size: 15px; display: none;">شماره موبایل باید 11 رقم باشد</p>
                                </div>
                                @error('mobile')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password" class="h6">کلمه عبور</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm">
                                        <p class="password-error" style="color: red; font-size: 15px; display: none;">پسوردها برابر نمی‌باشند</p>
                                </div>
                                @error('password')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password_retype" class="h6">تکرار کلمه عبور</label>
                                        <input type="password" name="password_confirmation" id="password_retype" class="form-control form-control-sm">
                                        <p class="password-error" style="color: red; font-size: 15px; display: none;">پسوردها برابر نمی‌باشند</p>
                                </div>
                                @error('password_confirmation')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">تصویر</label>
                                    <input type="file" name="profile_photo_path" id="image" class="form-control form-control-sm" accept="png,jpg,jpeg,webp">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">وضعیت فعال سازی</label>
                                    <select name="activation" id="Category-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('activation') == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('activation') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('activation')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
@section('script')
<script>
    const passwordInput = document.getElementById('password');
    const passwordRetypeInput = document.getElementById('password_retype');
    const errorParagraphs = document.querySelectorAll('.password-error');
    const mobile = document.getElementById('mobile')

    function validatePasswords() {
        const passwordsMatch = passwordInput.value === passwordRetypeInput.value;

        if (!passwordsMatch) {
            passwordInput.classList.add('is-invalid');
            passwordRetypeInput.classList.add('is-invalid');
        } else {
            passwordInput.classList.remove('is-invalid');
            passwordRetypeInput.classList.remove('is-invalid');
        }

        errorParagraphs.forEach(p => {
            p.style.display = passwordsMatch ? 'none' : 'block';
        });
    }

    function validateMobile() {
        const mobile = document.getElementById('mobile').value;
        const mobileError = document.querySelector('.mobile-error');

        if (mobile.length !== 11) {
            mobileError.style.display = 'block';
            return false;
        } else {
            mobileError.style.display = 'none';
            return true;
        }
    }


    passwordInput.addEventListener('input', validatePasswords);
    passwordRetypeInput.addEventListener('input', validatePasswords);
    document.getElementById('mobile').addEventListener('input' , validateMobile)

    [passwordInput, passwordRetypeInput].forEach(input => {
        ['copy', 'paste', 'cut', 'contextmenu'].forEach(eventType => {
            input.addEventListener(eventType, function(e) {
                e.preventDefault();
                alert('این عمل مجاز نیست.');

            });
        });
    });
</script>
@endsection
