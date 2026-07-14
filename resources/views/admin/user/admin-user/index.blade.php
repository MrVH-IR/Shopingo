@extends('admin.layouts.master')


@section('head-tag')
<title>کاربران ادمین</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
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
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            کاربران ادمین
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کاربران ادمین
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین چدید</a>
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
                            <th>فعال سازی</th>
                            <th>وضعیت</th>
                            <th>نقش</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($admins as $key => $admin)
                            <tr>
                                <th>{{ $key +1 }}</th>
                                <td>{{ $admin->email }}</td>
                                <th>{{ $admin->mobile }}</th>
                                <td>{{ $admin->first_name }}</td>
                                <td>{{ $admin->last_name }}</td>
                                <td>
                                    <div class="activation-wrapper" style="position: relative;">
                                        <label>
                                            <input id="activation-{{ $admin->id }}" onchange="changeActivation({{ $admin->id }})" type="checkbox"
                                                   @if($admin->activation == 1) checked @endif
                                                   data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $admin->id }}" onchange="changeStatus({{ $admin->id }})" type="checkbox"
                                                   @if($admin->status == 1) checked @endif
                                                   data-url="{{ route('admin.user.admin-user.status', $admin->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $admin->user_type == 1 ? "ادمین" : "کاربر" }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.user.permission.index', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>   نقش</a>
                                    <a href="{{ route('admin.user.admin-user.edit' , $admin->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.user.admin-user.destroy', $admin->id) }}" method="POST" id="delete-form-{{ $admin->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $admin->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $admin->id }}" >
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
