@extends('admin.layouts.master')


@section('head-tag')
<title>دسته بندی</title>
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
            دسته بندی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسته بندی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>دسته والد</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($productCategories as $productcategory)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $productcategory->name }}</td>
                                <td>{{ $productcategory->parent_id ? $productcategory->parent->name : 'منوی اصلی' }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.category.edit', $productcategory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.market.category.destroy', $productcategory->id) }}" method="POST" id="delete-form-{{ $productcategory->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $productcategory->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $productcategory->id }}" >
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

@endsection
@section('script')
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
