@extends('admin.layouts.master')


@section('head-tag')
    <title>رنگ کالا</title>
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
            <li class="breadcrumb-item font-size-12">
                <a href="{{ route('admin.market.product.index') }}">بخش محصولات</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                رنگ کالا
            </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        رنگ کالا
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.color.create' , $product->id) }}" class="btn btn-info btn-sm">ایجاد رنگ جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <th>#</th>
                        <th>نام کالا</th>
                        <th>رنگ کالا</th>
                        <th>افزایش قیمت </th>
                        <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($product->colors as $color)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $color->color_name }}</td>
                                <td>{{ $color->price_increase }}</td>
                                <td class="width-8-rem text-left">
                                    <form class="d-none" method="POST" action="{{ route('admin.market.color.destroy', ['product' => $product->id , 'color' => $color->id]) }}" id="delete-form-{{ $color->id }}">@csrf @method('DELETE')</form>
                                    <button type="submit" class="btn btn-danger btn-sm delete" form="delete-form-{{ $color->id }}" data-id="{{ $color->id }}"><i class="fa fa-trash-alt"></i>  حذف</button>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
