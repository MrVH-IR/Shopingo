@extends('admin.layouts.master')


@section('head-tag')
<title>مشتریان</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.user.customer.index') }}">بخش کاربران</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            مشتریان
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        مشتریان
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.create') }}" class="btn btn-info btn-sm">ایجاد مشتری چدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>کد ملی</th>
                            <th>فعال سازی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $value)
                            <tr>
                                <th>{{ $key +1 }}</th>
                                <td>{{ $value->email }}</td>
                                <th>{{ $value->mobile }}</th>
                                <td>{{ $value->first_name }}</td>
                                <td>{{ $value->last_name }}</td>
                                <td>{{ $value->national_code }}</td>
                                <td>
                                    <div class="activation-wrapper" style="position: relative;">
                                        <label>
                                            <input id="activation-{{ $value->id }}" onchange="changeActivation({{ $value->id }})" type="checkbox"
                                                   @if($value->activation == 1) checked @endif
                                                   data-url="{{ route('admin.user.customer.activation', $value->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $value->id }}" onchange="changeStatus({{ $value->id }})" type="checkbox"
                                                   @if($value->status == 1) checked @endif
                                                   data-url="{{ route('admin.user.customer.status', $value->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>   نقش</a>
                                    <a href="{{ route('admin.user.customer.edit' , $value->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.user.customer.destroy', $value->id) }}" method="POST" id="delete-form-{{ $value->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $value->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $value->id }}" >
                                        <i class="fa fa-trash-alt"></i> حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/activation.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
