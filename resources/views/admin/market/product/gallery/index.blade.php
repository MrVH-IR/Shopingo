@extends('admin.layouts.master')


@section('head-tag')
<title>اضافه کردن عکس به کالا</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
    <style>
        .image-sizes-btn-group .btn.active {
            background-color: #17a2b8;
            color: #fff;
            border-color: #138496;
        }
    </style>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.market.category.index') }}">بخش فروش</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            اضافه کردن عکس به کالا
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اضافه کردن عکس به کالا
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.gallery.create' , $product->id) }}" class="btn btn-info btn-sm">اضافه کردن عکس به کالای جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>تصویر کالا</th>
                            <th>تغییر سایز</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($product->images as $image)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if(isset($image->image['indexArray'][$image->image['currentImage']]))
                                        <img src="{{ asset($image->image['indexArray'][$image->image['currentImage']]) }}"
                                             data-large="{{ asset($image->image['indexArray']['large']) }}"
                                             alt="{{ $image->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="image-sizes-btn-group" data-id="{{ $image->id }}">
                                        <button data-size="small" class="btn btn-outline-secondary btn-sm">کوچک</button>
                                        <button data-size="medium" class="btn btn-outline-secondary btn-sm">متوسط</button>
                                        <button data-size="large" class="btn btn-outline-secondary btn-sm">بزرگ</button>
                                    </div>

                                    <div class="status-wrapper" style="position: relative;"></div>
                                </td>
                                <td class="width-8-rem text-left">
                                    <form class="d-none" method="POST" action="{{ route('admin.market.gallery.destroy', ['product' => $product->id , 'productImage' => $image->id]) }}" id="delete-form-{{ $image->id }}">@csrf @method('DELETE')</form>
                                    <button type="submit" class="btn btn-danger btn-sm delete" form="delete-form-{{ $product->id }}" data-id="{{ $image->id }}"><i class="fa fa-trash-alt"></i>  حذف</button>
                                </td>
                            </tr>
                        @endforeach
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

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/productGallerySizeModify.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
