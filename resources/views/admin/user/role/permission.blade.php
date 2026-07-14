@extends('admin.layouts.master')


@section('head-tag')
    <title>ایجاد نقش</title>
    <style>
        .permission-card {
            background: #f8f9fa;
            border: 1px solid #e1e5ea;
            border-radius: 10px;
            padding: 12px;
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .permission-card:hover {
            background: #e9ecef;
        }

        .permission-card input {
            display: none;
        }

        .permission-card label {
            display: block;
            margin: 0;
            cursor: pointer;
            font-weight: 500;
        }

        .permission-card input:checked + label {
            background: #0d6efd;
            color: #fff;
            border-radius: 8px;
            padding: 5px 10px;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <a href="{{ route('admin.home') }}">خانه</a>
            </li>
            <li class="breadcrumb-item font-size-12">
                <a href="#">بخش کاربران</a>
            </li>
            <li class="breadcrumb-item font-size-12">
                <a href="{{ route('admin.user.admin-user.index') }}">ادمین ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                ویرایش نقش کاربر
            </li>
        </ul>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش نقش کاربر
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="col-12 col-md-5">
                    <div class="card shadow-sm border-0 admin-info-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">اطلاعات ادمین</h6>

                            <div class="info-item">
                                <small class="text-muted">نام</small>
                                <div>{{ $user->first_name ?? '-' }}</div>
                            </div>

                            <div class="info-item">
                                <small class="text-muted">نام خانوادگی</small>
                                <div>{{ $user->last_name ?? '-' }}</div>
                            </div>

                            <div class="info-item mb-0">
                                <small class="text-muted">ایمیل</small>
                                <div>{{ $user->email ?? '-' }}</div>
                            </div>

                            <div class="info-item mb-0">
                                <small class="text-muted">موبایل</small>
                                <div>{{ $user->mobile ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <form action="{{ route('admin.user.permission.store', $user->id) }}" method="POST">
                        @csrf
                        <section class="row">
                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">
                                    <section class="col-12">
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach($roles as $role)
                                                <div class="permission-card"
                                                     style="flex: 1 1 calc(25% - 1rem); min-width:220px;">
                                                    <input type="checkbox"
                                                           name="role_id[]"
                                                           value="{{ $role->id }}"
                                                           id="perm-{{ $role->id }}"
                                                    @checked($userRoles->contains('id', $role->id))>
                                                    <label for="perm-{{ $role->id }}">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('user_id')
                                        <div class="alert alert-danger">
                                            <li>
                                                {{ $message }}
                                            </li>
                                        </div>
                                        @enderror
                                        @error('role_id')
                                        <div class="alert alert-danger">
                                            <li>
                                                {{ $message }}
                                            </li>
                                        </div>
                                        @enderror
                                    </section>
                                    <section class="col-12 col-md-2 mt-md-4">
                                        <button class="btn btn-primary btn-sm">ثبت</button>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </form>

                    <section class="mt-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-header">
                                <h6 class="mb-0">نقش‌های فعلی کاربر</h6>
                            </div>

                            <div class="card-body">
                                @forelse($user->roles as $role)
                                    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
                                        <div>
                                            <strong>{{ $role->name }}</strong>
                                            @if($role->description)
                                                <div class="text-muted small">
                                                    {{ $role->description }}
                                                </div>
                                            @endif
                                        </div>
                                        <form action="{{ route('admin.user.permission.destroy', $user->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('از حذف این نقش مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="role_id[]" value="{{ $role->id }}">
                                            <button class="btn btn-sm btn-danger">
                                                حذف نقش
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="alert alert-warning mb-0">
                                        این کاربر هیچ نقشی ندارد.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>

                </section>
            </section>
        </section>
    </section>

@endsection
