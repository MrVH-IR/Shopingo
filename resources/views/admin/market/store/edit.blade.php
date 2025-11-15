@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش انبار</title>
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
            <a href="{{ route('admin.market.store.index') }}">انبار</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش انبار
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
            ویرایش انبار
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.store.update' , $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="marketable_number" class="h6">تعداد موجودی</label>
                                        <input type="text" name="marketable_number" id="marketable_number" class="form-control form-control-sm" value="{{ old('marketable_number' , $product->marketable_number) }}">
                                </div>
                                @error('marketable_number')
                                <div class="alert alert-danger">
                                    <li>{{ $message }}</li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sold_out" class="h6">تعداد فروخته شده</label>
                                        <input type="text" name="sold_out" id="sold_out" class="form-control form-control-sm" value="{{ old('sold_out' , $product->sold_out) }}" disabled>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="frozen_number" class="h6">تعداد رزرو شده</label>
                                        <input type="text" name="frozen_number" id="frozen_number" class="form-control form-control-sm" value="{{ old('frozen_number' , $product->frozen_number) }}" disabled>
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
