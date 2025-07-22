@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد مشتری</title>
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
            <a href="#">کاربران</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
           ایجاد مشتری
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
         ایجاد مشتری
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام خانوادگی</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">ایمیل</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">شماره موبایل</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">کلمه عبور</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm">
                                        <p class="password-error" style="color: red; font-size: 15px; display: none;">پسوردها برابر نمی‌باشند</p>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">تکرار کلمه عبور</label>
                                        <input type="password" name="password_retype" id="password_retype" class="form-control form-control-sm">
                                        <p class="password-error" style="color: red; font-size: 15px; display: none;">پسوردها برابر نمی‌باشند</p>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">تصویر</label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm" accept="png,jpg,jpeg,webp">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">وضعیت کاربر</label>
                                        <select name="" id="" class="form-control form-control-sm">
                                            <option value="active">فعال</option>
                                            <option value="deactive">عیر فعال</option>
                                        </select>
                                </div>
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


    passwordInput.addEventListener('input', validatePasswords);
    passwordRetypeInput.addEventListener('input', validatePasswords);

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
