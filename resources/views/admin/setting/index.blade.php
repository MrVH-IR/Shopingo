@extends('admin.layouts.master')


@section('head-tag')
<title>تنظیمات</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            تنظیمات
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        تنظیمات
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a class="btn btn-info btn-sm disabled">ایجاد تنظیمات چدید</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نام سایت</th>
                            <th>توضیحات سایت</th>
                            <th>کلمات کلیدی</th>
                            <th>لوگو</th>
                            <th>آیکون</th>
                            <th>Optimization</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ $setting->id }}</th>
                                <td>{{ $setting->title }}</td>
                                <td>{{ $setting->description }}</td>
                                <td>{{ $setting->keywords }}</td>
                                <td>
                                    @if(isset($setting->logo))
                                        <img src="{{ asset($setting->logo) }}"
                                             data-large="{{ asset($setting->logo) }}"
                                             alt="{{ $setting->logo }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($setting->favicon))
                                        <img src="{{ asset($setting->favicon) }}"
                                             data-large="{{ asset($setting->favicon) }}"
                                             alt="{{ $setting->favicon }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="submit" form="optimization_form" class="bg-info">Optimize</button>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.setting.edit' , $setting->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

<div id="imageModal" class="modal-overlay">
    <span class="close-btn">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

    <form class="d-none" action="{{ route('admin.setting.optimization') }}" method="POST" id="optimization_form">@csrf</form>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
@endsection
