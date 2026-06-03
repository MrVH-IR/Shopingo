@extends('admin.layouts.master')


@section('head-tag')
    <title>بنر ها</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <a href="{{ route('admin.home') }}">خانه</a>
            </li>
            <li class="breadcrumb-item font-size-12">
                <a href="{{ route('admin.content.category.index') }}">بخش محتوا</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                بنر ها
            </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        بنر ها
                    </h5>
                    @include('admin.alerts.alertsection.success')
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner.create') }}" class="btn btn-info btn-sm">ایجاد بنر</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان بنر</th>
                            <th>آدرس</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th></th>
                            <th>مکان</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->link }}</td>
                                <td>
                                    @php
                                        $image = $banner->image;
                                    @endphp
                                    @if(is_array($image) && isset($image['indexArray'][$image['currentImage']]))
                                        <img src="{{ asset($image['indexArray'][$image['currentImage']]) }}"
                                             data-large="{{ asset($image['indexArray']['large']) }}"
                                             alt="{{ $banner->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; cursor: pointer;"
                                             loading="lazy">
                                    @elseif(is_string($image) && !empty($image))
                                        <img src="{{ asset($image) }}"
                                             data-large="{{ asset($image) }}"
                                             alt="{{ $banner->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>@if($banner->status)
                                        <span class="badge badge-success p-2 fs-2">فعال</span>
                                    @else
                                        <span class="badge badge-danger p-2 fs-2">غیر فعال</span>
                                    @endif</td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $banner->id }}" onchange="changeStatus({{ $banner->id }})" type="checkbox"
                                                   @if($banner->status == 1) checked @endif
                                                   data-url="{{ route('admin.content.banner.status', $banner->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $positions[$banner->position] }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.banner.edit' , $banner->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.content.banner.destroy', $banner->id) }}" method="POST" id="delete-form-{{ $banner->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $banner->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $banner->id }}" >
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

    {{ $banners->links() }}

    <div id="imageModal" class="modal-overlay">
        <span class="close-btn">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>

    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
