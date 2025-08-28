@extends('admin.layouts.master')


@section('head-tag')
<title>پست ها</title>
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
             <a href="{{ route('admin.content.category.index') }}">بخش کحتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            پست ها
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        پست ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.create') }}" class="btn btn-info btn-sm">ایجاد پست جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>دسته</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th>امکان درج کامنت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <th>{{ $key +=1 }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>

                                    @if(isset($post->image['indexArray'][$post->image['currentImage']]))
                                        <img src="{{ asset($post->image['indexArray'][$post->image['currentImage']]) }}"
                                             data-large="{{ asset($post->image['indexArray']['large']) }}"
                                             alt="{{ $post->name }}"
                                             class="preview-img"
                                             style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                             loading="lazy">
                                    @else
                                        <span class="text-muted">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>
                                    <label>
                                        <div class="status-wrapper" style="position: relative;">
                                            <input id="status-{{ $post->id }}" onchange="changeStatus('status-{{ $post->id }}')" type="checkbox"
                                                   @if($post->status == 1) checked @endif
                                                   data-url="{{ route('admin.content.post.status' , $post->id) }}">
                                        </div>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <div class="status-wrapper" style="position: relative;">
                                            <input id="commentable-{{ $post->id }}" onchange="changeStatus('commentable-{{ $post->id }}')" type="checkbox"
                                                   @if($post->commentable == 1) checked @endif
                                                   data-url="{{ route('admin.content.post.commentable' , $post->id) }}">
                                        </div>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.post.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.content.post.destroy', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $post->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $post->id }}" >
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

    {{ $posts->links() }}

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
