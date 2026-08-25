@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش نقش</title>
@endsection
@section('content')
    <div class="space-y-6">@include('admin.components.ui.page-header',['title'=>'ویرایش نقش','description'=>'نقش و دسترسی‌های سیستم را مدیریت کنید.','breadcrumbs'=>[['label'=>'خانه','url'=>route('admin.home')],['label'=>'بخش کاربران'],['label'=>'نقش ها','url'=>route('admin.user.role.index')],['label'=>'ویرایش']], 'actionUrl'=>route('admin.user.role.index'),'actionLabel'=>'بازگشت','actionIcon'=>'fas fa-arrow-right'])
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.user.role.update', $role->id) }}" method="POST"
                  class="space-y-6">@csrf @method('PUT')
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2"><label class="text-sm font-semibold text-slate-700">عنوان نقش</label><input
                                type="text" name="name" value="{{ old('name', $role->name) }}"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">@include('admin.components.ui.field-error',['name'=>'name'])
                    </div>
                    <div class="space-y-2"><label class="text-sm font-semibold text-slate-700">توضیح نقش</label><input
                                type="text" name="description" value="{{ old('description', $role->description) }}"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">@include('admin.components.ui.field-error',['name'=>'description'])
                    </div>
                    <div class="space-y-2"><label class="text-sm font-semibold text-slate-700">وضعیت</label><select
                                name="status"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $role->status)==0)>غیرفعال</option>
                            <option value="1" @selected(old('status', $role->status)==1)>فعال</option>
                        </select>@include('admin.components.ui.field-error',['name'=>'status'])</div>
                </div>
                <div class="border-t border-slate-100 pt-6">
                    <div class="mb-4"><h3 class="text-base font-bold text-slate-900">دسترسی‌ها</h3>
                        <p class="mt-1 text-sm text-slate-500">دسترسی‌های مورد نیاز این نقش را انتخاب کنید.</p></div>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">@foreach($permissions as $permission)
                            <label class="group cursor-pointer"><input type="checkbox" name="permissions[]"
                                                                       value="{{ $permission->id }}"
                                                                       id="perm-{{ $permission->id }}"
                                                                       class="peer sr-only"
                                                                       @if($role->permissions->contains($permission->id)) checked @endif><span
                                        class="block rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-700 transition hover:border-cyan-200 hover:bg-cyan-50 peer-checked:border-cyan-500 peer-checked:bg-cyan-600 peer-checked:text-white">{{ $permission->description }}</span></label>
                        @endforeach</div>@include('admin.components.ui.field-error',['name'=>'permissions'])</div>
                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">
                        <i class="fas fa-save"></i>ثبت نقش
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
