@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش روش ارسال</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.market.brand.index') }}">بخش فروش</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.market.delivery.index') }}">روش های ارسال</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش روش ارسال
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش روش ارسال
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.update' , $delivery->id) }}" method="POST">
                        @method("PUT")
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام روش ارسال</label>
                                        <input type="text" name="name" value="{{ old('name' , $delivery->name) }}" class="form-control form-control-sm">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">هزینه روش ارسال</label>
                                        <input type="text" name="amount" value="{{ old('amount' , $delivery->amount) }}" class="form-control form-control-sm">
                                </div>
                                @error('amount')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">مقدار زمان ارسال</label>
                                        <input type="text" name="delivery_time" value="{{ old('delivery_time' , $delivery->getRawOriginal('delivery_time')) }}" class="form-control form-control-sm">
                                </div>
                                @error('delivery_time')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نوع زمان ارسال</label>
                                    <input type="text" name="delivery_time_unit" value="{{ old('delivery_time_unit' , $delivery->delivery_time_unit) }}" class="form-control form-control-sm">
                                </div>
                                @error('delivery_time_unit')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">وضعیت</label>
                                    <select name="status" id="Category-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status' , $delivery->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $delivery->status) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
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
