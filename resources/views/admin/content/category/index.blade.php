@extends('admin.layouts.master')


@section('head-tag')
<title>دسته بندی</title>
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        z-index: 999;
        inset: 0;
        background-color: rgba(0,0,0,0.85);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        max-width: 90vw;
        max-height: 90vh;
        width: auto;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(0,0,0,0.6);
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 40px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        transition: color 0.3s;
        z-index: 1000;
    }
    .close-btn:hover {
        color: #ff4d4d;
    }

    .fade-in {
        animation: modalFadeIn 0.3s ease forwards;
    }
    .zoom-in {
        animation: zoomIn 0.3s ease forwards;
    }

    .fade-out {
        animation: modalFadeOut 0.3s ease forwards;
    }
    .zoom-out {
        animation: zoomOut 0.3s ease forwards;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes modalFadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    @keyframes zoomIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    @keyframes zoomOut {
        from { transform: scale(1); opacity: 1; }
        to { transform: scale(0.8); opacity: 0; }
    }
    .status-message {
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        color: white;
        animation: statusFadeIn 0.3s ease, statusFadeOut 0.3s ease 2.5s;
    }
    .status-success {
        background-color: #28a745;
    }
    .status-error {
        background-color: #dc3545;
    }

    @keyframes statusFadeIn {
        from { opacity: 0; transform: translate(-50%, -10px); }
        to { opacity: 1; transform: translate(-50%, 0); }
    }
    @keyframes statusFadeOut {
        from { opacity: 1; transform: translate(-50%, 0); }
        to { opacity: 0; transform: translate(-50%, -10px); }
    }
</style>
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
                        @foreach($categories as $category)
                            <tr>
                                <th>{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <img src="{{ $category->image }}"
                                         alt="images"
                                         class="preview-img"
                                         style="max-width: 150px; max-height: 150px; width: auto; height: auto; cursor: pointer;"
                                         loading="lazy">
                                </td>
                                <td>{{ $category->tags }}</td>
                                <td>
                                    <div class="status-wrapper" style="position: relative;">
                                        <label>
                                            <input id="{{ $category->id }}" onchange="changeStatus({{ $category->id }})" type="checkbox"
                                                   @if($category->status == 1) checked @endif
                                                   data-url="{{ route('admin.content.category.status', $category->id) }}">
                                        </label>
                                    </div>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.category.edit' , $category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.content.category.destroy', $category->id) }}" method="POST" id="delete-form-{{ $category->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $category->id }}" class="btn btn-danger btn-sm">
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
            {{ $categories->links() }}

    <div id="imageModal" class="modal-overlay">
        <span class="close-btn">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const closeBtn = document.querySelector('.close-btn');

            document.querySelectorAll('.preview-img').forEach(img => {
                img.addEventListener('click', function() {
                    modal.style.display = "flex";
                    modal.classList.remove('fade-out');
                    modalImg.classList.remove('zoom-out');
                    modal.classList.add('fade-in');
                    modalImg.classList.add('zoom-in');
                    modalImg.src = this.src;
                });
            });

            function closeModal() {
                modal.classList.remove('fade-in');
                modalImg.classList.remove('zoom-in');
                modal.classList.add('fade-out');
                modalImg.classList.add('zoom-out');
                setTimeout(() => {
                    modal.style.display = "none";
                }, 300);
            }

            closeBtn.addEventListener('click', closeModal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        });
    </script>
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#" + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');
            var wrapper = element.closest('.status-wrapper');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked)
                            element.prop('checked', true);
                        else
                            element.prop('checked', false);

                        showStatusMessage(wrapper, 'وضعیت با موفقیت تغییر کرد', true);

                    } else {
                        element.prop('checked', elementValue);

                        showStatusMessage(wrapper, 'تغییر وضعیت با خطا مواجه شد', false);
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    showStatusMessage(wrapper, 'خطای ارتباط با سرور', false);
                }
            });
        }
            function showStatusMessage(wrapper, message, success = true) {
                wrapper.find('.status-message').remove();

                var msg = $('<div>')
                    .addClass('status-message')
                    .addClass(success ? 'status-success' : 'status-error')
                    .text(message);

                wrapper.append(msg);

                setTimeout(() => {
                    msg.fadeOut(300, function() { $(this).remove(); });
                }, 3000);
            }
    </script>
@endsection
