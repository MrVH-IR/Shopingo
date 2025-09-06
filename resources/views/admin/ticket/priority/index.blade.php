@extends('admin.layouts.master')

@section('head-tag')
<title>اولویت</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">اولویت</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    اولویت
                </h5>
            </section>

            @include('admin.alerts.alertsection.success')

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.ticket.priority.create') }}" class="btn btn-info btn-sm">ایجاد اولویت</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام اولویت</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ticketPriorities as $key => $ticketPriority)

                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $ticketPriority->name }}</td>
                            <td>
                                <div class="status-wrapper" style="position: relative;">
                                    <label>
                                        <input id="{{ $ticketPriority->id }}" onchange="changeStatus({{ $ticketPriority->id }})" type="checkbox"
                                               @if($ticketPriority->status == 1) checked @endif
                                               data-url="{{ route('admin.ticket.priority.status', $ticketPriority->id) }}">
                                    </label>
                                </div>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.ticket.priority.edit', $ticketPriority->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{ route('admin.ticket.priority.destroy', $ticketPriority->id) }}" method="POST" id="delete-form-{{ $ticketPriority->id }}" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="submit" form="delete-form-{{ $ticketPriority->id }}"
                                        class="btn btn-danger btn-sm delete"
                                        data-id="{{ $ticketPriority->id }}" >
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
