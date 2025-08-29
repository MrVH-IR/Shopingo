@extends('admin.layouts.master')


@section('head-tag')
<title>نظرات</title>
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
        <li class="breadcrumb-item font-size-12" aria-current="page">
            نظرات
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            نمایش نظر
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظر
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-primary">
                        <p>{{ $comment->author->first_name }} -- {{ $comment->author_id }}</p>
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">ساعت apple watch - sm-12 کد کالا:512512</h5>
                        <div class="card-text">
                            <span class="text-preview">
                                {{ substr(strip_tags($comment->body), 0, 50) }}...
                            </span>
                                                <span class="text-full" style="display: none;">
                                {{ strip_tags($comment->body) }}
                            </span>
                            @if (strlen($comment->body) > 50)
                                <a href="#" class="read-more text-primary small" style="font-size: 0.9em;">
                                    نمایش بیشتر
                                </a>
                            @endif
                        </div>
                    </section>
                </section>
                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="Category" class="h6">پاسخ ادمین</label>
                                       <textarea name="admin-response" id="admin-response" class="form-control form-control-sm" rows="4"></textarea>
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
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const readMoreLinks = document.querySelectorAll('.read-more');

            readMoreLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const fullText = this.previousElementSibling;
                    const previewText = fullText.previousElementSibling;

                    if (fullText.style.display === 'inline') {
                        fullText.style.display = 'none';
                        previewText.style.display = 'inline';
                        this.textContent = 'نمایش بیشتر';
                    } else {
                        fullText.style.display = 'inline';
                        previewText.style.display = 'none';
                        this.textContent = 'نمایش کمتر';
                    }
                });
            });
        });
    </script>
@endsection
