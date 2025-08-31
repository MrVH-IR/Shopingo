@extends('admin.layouts.master')

@section('head-tag')
<title>اطلاعیه پیامکی</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.email.index') }}"> اطلاع رسانی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            اطلاعیه پیامکی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اطلاعیه پیامکی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.sms.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه پیامکی جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>عنوان اطلاعیه</th>
                            <th>متن پیامک</th>
                            <th>تاریخ ارسال</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($sms as $key => $value)
                            <tr>
                                <th>{{ $key +1 }}</th>
                                <td>{{ $value->title }}</td>
                                <td>{{ substr($value->body , 0 , 100) }} @if(mb_strlen($value->body) > 100) <p>...</p> @endif</td>
                                <td>{{ $value->published_at_jalali }}</td>
                                <td>
                                    <label>
                                        <div class="status-wrapper" style="position: relative;">
                                            <input id="status-{{ $value->id }}" onchange="changeStatus('status-{{ $value->id }}')" type="checkbox"
                                                   @if($value->status == 1) checked @endif
                                                   data-url="{{ route('admin.sms.status' , $value->id) }}">
                                        </div>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.sms.edit' , $value->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  ویرایش</a>
                                    <form action="{{ route('admin.sms.destroy' , $value->id) }}" class="d-none" id="delete-form-{{ $value->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                    <button type="submit" form="delete-form-{{ $value->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $value->id }}">
                                        <i class="fa fa-clock"></i>   حذف
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

    {{ $sms->links() }}

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
