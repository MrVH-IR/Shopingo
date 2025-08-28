@extends('admin.layouts.master')


@section('head-tag')
<title>سوالات متداول</title>
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
            سوالات متداول
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                         سوالات متداول
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.faq.create') }}" class="btn btn-info btn-sm">ایجاد پرسش چدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>پرسش</th>
                            <th>خلاصه پاسخ</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                        @foreach($faqs as $key => $faq)
                            <tr>
                                <th>{{ $key +=1 }}</th>
                                <td>{{ $faq->question }}</td>

                                @php
                                    $answer = strip_tags($faq->answer);
                                @endphp
                                <td>{{ substr($answer , 0 , 20) }}...</td>
                                <td>
                                    <label>
                                        <div class="status-wrapper" style="position: relative;">
                                            <input id="{{ $faq->id }}" onchange="changeStatus('{{ $faq->id }}')" type="checkbox"
                                                   @if($faq->status == 1) checked @endif
                                                   data-url="{{ route('admin.content.faq.status' , $faq->id) }}">
                                        </div>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.faq.edit' , $faq->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <form action="{{ route('admin.content.faq.destroy', $faq->id) }}" method="POST" id="delete-form-{{ $faq->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" form="delete-form-{{ $faq->id }}"
                                            class="btn btn-danger btn-sm delete"
                                            data-id="{{ $faq->id }}" >
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

    {{ $faqs->links() }}

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
