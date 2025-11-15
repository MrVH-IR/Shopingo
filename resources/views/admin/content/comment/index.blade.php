@extends('admin.layouts.master')

@section('head-tag')
<title>نظرات</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.content.category.index') }}">بخش محتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            نظرات
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm" tabindex="-1" aria-disabled="true" style="cursor: not-allowed; pointer-events: none; opacity: 0.65;">ایجاد نظر جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نظر</th>
                            <th>نویسنده نظر</th>
                            <th>پاسخ به</th>
                            <th>کد کاربر</th>
                            <th>کد پست</th>
                            <th>پست</th>
                            <th>وضعیت تایید</th>
                            <th>وضعیت کامنت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($comments as $key => $comment)
                            <tr>
                                <th>{{ $key +=1 }}</th>
                                <td><a href="{{ route('admin.content.comment.show' , $comment->id) }}">{{ substr($comment->body , 0 , 15) }}...</a></td>
                                <td>{{ $comment->author->full_name }}</td>
                                <td>
                                    @if($comment->parent_id)
                                        <a href="{{ route('admin.content.comment.show', $comment->parent_id) }}">
                                            {{ substr($comment->parent->body, 0, 20) }}
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $comment->author_id }}</td>
                                <td>{{ $comment->commentable_id }}</td>
                                <td>{{ $comment->commentable?->title }}</td>
                                <td>{{ $comment->approved_label }}</td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $comment->id }}" onchange="changeStatus({{ $comment->id }})" type="checkbox"
                                                   @if($comment->status == 1) checked @endif
                                                   data-url="{{ route('admin.content.comment.status', $comment->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.comment.show' , $comment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  نمایش</a>
                                    <form class="d-none" id="approve-{{ $comment->id }}" action="{{ route('admin.content.comment.approved' , $comment->id) }}" method="POST">
                                        @csrf
                                    </form>
                                    <button data-id="{{ $comment->id }}" type="button" form="approve-{{ $comment->id }}" title="{{ $comment->approved ? 'این کامنت تایید شده است' : 'این کامنت هنوز تایید نشده' }}" class="btn {{ $comment->approved ? "btn-success" : "btn-warning" }} btn-sm toggle-approve"><i class="fa {{ $comment->approved ? "fa-check" : "fa-clock" }}"></i>  {{ $comment->approved ? "تایید شده" : "تایید نشده" }}</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

    {{ $comments->links() }}

@endsection
@section('script')
<script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin-assets/js/toggleApprove.js') }}"></script>
@endsection
