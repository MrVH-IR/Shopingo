@extends('admin.layouts.master')


@section('head-tag')
<title>پیج ساز</title>
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
            <a href="{{ route('admin.content.page.index') }}">پیج ساز</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
             ایجاد پیج
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                       ایجاد پیج
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.page.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">عنوان</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">آدرس url</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12">
                                <label for="faq">محتوا</label>
                                <textarea name="body" id="body" class="form-control form-control-sm" rows="10"></textarea>
                            </section>
                            <section class="col-12 mt-3">
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
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {
                language: 'fa',
                toolbar: [
                    'heading',
                    '|',
                    'bold', 'italic', 'underline', 'strikethrough',
                    'subscript', 'superscript',
                    '|',
                    'fontColor', 'fontBackgroundColor', 'fontSize', 'fontFamily',
                    '|',
                    'link', 'blockQuote', 'code', 'codeBlock',
                    '|',
                    'bulletedList', 'numberedList', 'todoList',
                    'outdent', 'indent', 'alignment',
                    '|',
                    'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells',
                    '|',
                    'highlight', 'selectAll',
                    '|',
                    'undo', 'redo', 'imageUpload' , 'imageStyle:full/side/inline' , 'imageTextAlternative' , 'mediaEmbed'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
