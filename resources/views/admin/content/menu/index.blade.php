@extends('admin.layouts.master')


@section('head-tag')
<title>منو</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.content.page.index') }}">بخش محتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            منو
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        منو
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.menu.create') }}" class="btn btn-info btn-sm">ایجاد منوی جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نام منو</th>
                            <th>منو والد</th>
                            <th>لینک منو</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($menus as $key => $menu)
                            <tr>
                                <th>{{ $key +=1 }}</th>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->parent_id ? $menu->parent->name : "ندارد" }}</td>
                                <td>{{ config('app.url') . "/" . $menu->url }}</td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $menu->id }}" onchange="changeStatus({{ $menu->id }})" type="checkbox"
                                            @if($menu->status == 1) checked @endif
                                            data-url="{{ route('admin.content.menu.status' , $menu->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.menu.edit' , $menu->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form class="d-none" id="delete-form-{{ $menu->id }}" method="POST" action="{{ route('admin.content.menu.destroy' , $menu->id) }}">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                    <button type="submit" form="delete-form--{{ $menu->id }}" data-id="{{ $menu->id }}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-alt"></i>  حذف</button>
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
