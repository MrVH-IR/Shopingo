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
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="#">بخش کاربران</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.user.role.index') }}">نقش ها</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
           ایجاد نقش
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
         ایجاد نقش
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.store') }}" method="POST">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="Category" class="h6">عنوان نقش</label>
                                        <input type="text" name="name" class="form-control form-control-sm">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">
                                        <li>
                                            {{ $message }}
                                        </li>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="Category" class="h6">توضیح نقش</label>
                                        <input type="text" name="description" class="form-control form-control-sm">
                                </div>
                                @error('description')
                                    <div class="alert alert-danger">
                                        <li>
                                            {{ $message }}
                                        </li>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Status-Select" class="h6">وضعیت</label>
                                    <select name="status" id="Status-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status') == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
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
                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">
                                    <section class="col-12">
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach($permissions as $permission)
                                                <div class="permission-card" style="flex: 1 1 calc(25% - 1rem); min-width:220px;">
                                                    <input type="checkbox"
                                                           name="permissions[]"
                                                           value="{{ $permission->id }}"
                                                           id="perm-{{ $permission->id }}">
                                                    <label for="perm-{{ $permission->id }}">
                                                        {{ $permission->description }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('permissions')
                                        <div class="alert alert-danger">
                                            <li>
                                                {{ $message }}
                                            </li>
                                        </div>
                                        @enderror
                                    </section>
                                </section>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
