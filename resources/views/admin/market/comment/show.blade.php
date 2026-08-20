@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.comment.index') }}" class="hover:text-slate-900">نظرات</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">نمایش نظر</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">نمایش نظر</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">جزئیات نظر، متن کامل و فرم پاسخ ادمین در همین صفحه قرار دارد.</p>
                </div>

                <a href="{{ route('admin.market.comment.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="overflow-hidden rounded-3xl border border-slate-200">
                <div class="bg-gradient-to-r from-slate-900 to-cyan-900 px-5 py-4 text-white">
                    <p class="text-sm font-semibold">{{ $comment->author?->fullName }} - {{ $comment->author_id }}</p>
                </div>
                <div class="space-y-4 p-5">
                    <h2 class="text-lg font-bold text-slate-900">{{ $comment->commentable->title ?? '' }}</h2>
                    <div class="rounded-2xl bg-slate-50 p-4 text-sm leading-7 text-slate-700">
                        <span class="text-preview">{{ \Illuminate\Support\Str::limit(strip_tags($comment->body), 120) }}</span>
                        <span class="text-full hidden">{{ strip_tags($comment->body) }}</span>
                        @if (strlen($comment->body) > 120)
                            <a href="#" class="read-more mt-2 inline-flex text-cyan-700 hover:text-cyan-900">نمایش بیشتر</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if($comment->parent == null)
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900">پاسخ ادمین</h3>
                <form action="{{ route('admin.market.comment.answer', $comment->id) }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label for="body" class="text-sm font-semibold text-slate-700">متن پاسخ</label>
                        <textarea name="body" id="body" rows="5" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">{{ old('body') }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                            <i class="fas fa-paper-plane"></i>
                            ثبت پاسخ
                        </button>
                    </div>
                </form>
            </section>
        @endif
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.read-more').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const box = this.closest('.rounded-2xl');
                    const preview = box.querySelector('.text-preview');
                    const full = box.querySelector('.text-full');
                    const expanded = !full.classList.contains('hidden');

                    full.classList.toggle('hidden', expanded);
                    preview.classList.toggle('hidden', !expanded);
                    this.textContent = expanded ? 'نمایش بیشتر' : 'نمایش کمتر';
                });
            });
        });
    </script>
@endsection
