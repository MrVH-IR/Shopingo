@extends('admin.layouts.master')


@section('head-tag')
<title>انبار</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
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
            انبار
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        انبار
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد انبار جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <td>نام کالا</td>
                            <td>تصویر کلا</td>
                            <td>تعداد قابل فروش</td>
                            <td>تعداد رزرو شده</td>
                            <td>تعداد فروخته شده</td>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $product->name }}</th>
                                <th>
                                    @if(isset($product->image['indexArray'][$product->image['currentImage']]))
                                        <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                             data-large="{{ asset($product->image['indexArray']['large']) }}"
                                             alt="{{ $product->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </th>
                                <th>{{ $product->marketable_number }}</th>
                                <th>{{ $product->frozen_number }}</th>
                                <th>{{ $product->sold_out }}</th>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.store.addToStore' , $product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                    <a href="{{ route('admin.market.store.edit' , $product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i>  اصلاح موجودی</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

    {{ $products->links() }}

<div id="imageModal" class="modal-overlay">
    <span class="close-btn">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
@endsection
