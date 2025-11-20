@extends('admin.layouts.master')


@section('head-tag')
<title>کالا ها</title>
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
             <a href="{{ route('admin.market.category.index') }}">بخش فروش</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
           کالا ها
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                         کالا ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">ایجاد کالای جدید</a>
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
                            <th>قیمت کالا</th>
                            <th>وزن کالا</th>
                            <th>دسته</th>
                            <th>فرم کالا</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if(is_array($product->image) && isset($product->image['indexArray'][$product->image['currentImage']]))
                                        <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                             data-large="{{ asset($product->image['indexArray']['large']) }}"
                                             alt="{{ $product->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>{{ $product->price }} تومان</td>
                                <td>{{ $product->weight }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>اندازه نمایشگر</td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $product->id }}" onchange="changeStatus({{ $product->id }})" type="checkbox"
                                                   @if($product->status == 1) checked @endif
                                                   data-url="{{ route('admin.market.product.status', $product->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="{{ route('admin.market.gallery.index' , $product->id) }}"><i class="fa fa-images"></i>گالری</a>
                                            <a class="dropdown-item text-right" href="{{ route('admin.market.color.index' , $product->id) }}"><i class="fa fa-list-ul"></i>رنگ کالا</a>
                                            <a class="dropdown-item text-right" href="{{ route('admin.market.product.edit' , $product->id) }}"><i class="fa fa-edit"></i>ویرایش</a>
                                            <form action="{{ route('admin.market.product.destroy' , $product->id) }}" method="POST" class="d-none" id="delete-form-{{ $product->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="submit" class="dropdown-item text-right" form="delete-form-{{ $product->id }}"
                                             data-id="{{ $product->id }}"><i class="fa fa-window-close delete"></i> حذف</button>
                                        </div>
                                    </div>
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>

    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
