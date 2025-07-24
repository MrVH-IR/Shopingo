@extends('admin.layouts.master')


@section('head-tag')
<title>نمایش تیکت ها</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.market.category.index') }}">بخش تیکت ها</a>
        </li>
        <li class="breadcrumb-item font-size-12" aria-current="page">
            تیکت
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            مشاهده تیکت
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش تیکت ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.ticket.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-primary">
                        <p>کامران محمدی - 651251</p>
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">موضوع:پنل سفارش</h5>
                        <p class="card-text">من دیروز خرید کردم ولی به بخش سفارشات پنل نمی توانم بروم و وضعیت سفارش را ببینم</p>
                    </section>
                </section>
                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="Category" class="h6">پاسخ تیکت</label>
                                       <textarea name="admin-response" id="admin-response" class="form-control form-control-sm" rows="4"></textarea>
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
