@extends('admin.layouts.master')


@section('head-tag')
<title>فروش شگفت انگیز</title>
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
            فروش شگفت انگیز
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
            فروش شگفت انگیز
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.amazingSale.create') }}" class="btn btn-info btn-sm">افزودن کالا به لیست شگفت انگیز</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>درصد تخفیف</th>
                            <th>تاریخ شروع</th>
                            <th>تاریخ پایان</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($amazingSales as $amazingSale)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $amazingSale->product->name }}</th>
                                <td>{{ $amazingSale->percentage }}%</td>
                                <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($amazingSale->start_at) }}</td>
                                <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($amazingSale->end_at) }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.discount.amazingSale.edit' , $amazingSale->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form class="d-none" method="POST" action="{{ route('admin.market.discount.amazingSale.destroy' , $amazingSale->id) }}" id="delete-form-{{ $amazingSale->id }}">@csrf @method('DELETE')</form>
                                    <button type="submit" class="btn btn-danger btn-sm delete" form="delete-form-{{ $amazingSale->id }}" data-id="{{ $amazingSale->id }}"><i class="fa fa-trash-alt"></i>  حذف</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

    {{ $amazingSales->links() }}

@endsection
@section('script')

    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
