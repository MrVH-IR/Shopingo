@extends('admin.layouts.master')


@section('head-tag')
<title>دسته بندی</title>
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
                    @include('admin.alerts.alertsection.success')
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>توضیحات</th>
                            <th>اسلاگ</th>
                            <th>عکس ها</th>
                            <th>تگ ها</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($postCategories as $key => $postCategory)
                            <tr>
                                <th>{{ $key +=1 }}</th>
                                <td>{{ $postCategory->name }}</td>
                                <td>{{ $postCategory->description }}</td>
                                <td>{{ $postCategory->slug }}</td>
                                <td>
                                    @if(isset($postCategory->image['indexArray'][$postCategory->image['currentImage']]))
                                        <img src="{{ asset($postCategory->image['indexArray'][$postCategory->image['currentImage']]) }}"
                                             data-large="{{ asset($postCategory->image['indexArray']['large']) }}"
                                             alt="{{ $postCategory->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>{{ $postCategory->tags }}</td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $postCategory->id }}" onchange="changeStatus({{ $postCategory->id }})" type="checkbox"
                                                   @if($postCategory->status == 1) checked @endif
                                                   data-url="{{ route('admin.content.category.status', $postCategory->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.category.edit' , $postCategory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.content.category.destroy', $postCategory->id) }}" method="POST" id="delete-form-{{ $postCategory->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $postCategory->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $postCategory->id }}" >
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

    {{ $postCategories->links() }}

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
