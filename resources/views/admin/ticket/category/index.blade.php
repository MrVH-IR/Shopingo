@extends('admin.layouts.master')

@section('head-tag')
<title>دسته بندی</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
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

            @include('admin.alerts.alertsection.success')

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.ticket.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ticketCategories as $key => $ticketCategory)

                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $ticketCategory->name }}</td>
                            <td>
                                <div class="status-wrapper" style="position: relative;">
                                    <label>
                                        <input id="{{ $ticketCategory->id }}" onchange="changeStatus({{ $ticketCategory->id }})" type="checkbox"
                                               @if($ticketCategory->status == 1) checked @endif
                                               data-url="{{ route('admin.ticket.category.status', $ticketCategory->id) }}">
                                    </label>
                                </div>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.ticket.category.edit', $ticketCategory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{ route('admin.ticket.category.destroy', $ticketCategory->id) }}" method="POST" id="delete-form-{{ $ticketCategory->id }}" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="submit" form="delete-form-{{ $ticketCategory->id }}"
                                        class="btn btn-danger btn-sm delete"
                                        data-id="{{ $ticketCategory->id }}" >
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
