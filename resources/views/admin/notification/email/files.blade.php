<div class="mt-6 space-y-4">
    <div class="flex items-center gap-2">
        <i class="fas fa-paperclip text-cyan-600"></i>
        <h3 class="text-sm font-bold text-slate-900">فایل‌های پیوست</h3>
    </div>

    @if($emailFiles->isNotEmpty())
        <div class="space-y-3">
            @foreach($emailFiles as $emailFile)
                <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-slate-800">{{ basename($emailFile->file_path) }}</p>
                        <p class="mt-1 text-xs text-slate-500">
                            Type: {{ strtoupper($emailFile->file_type) }} |
                            Size: {{ \App\Http\Services\File\FileToolsService::formatSize($emailFile->file_size) }}
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('admin.email.file.download', $emailFile->id) }}" target="_blank" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                            <i class="fas fa-download"></i>
                            مشاهده / دانلود
                        </a>
                        <form action="{{ route('admin.email.file.delete', $emailFile) }}" method="POST" class="inline" onsubmit="return confirm('آیا از حذف این فایل اطمینان دارید؟')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="file_id" value="{{ $emailFile->id }}">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
                                <i class="fas fa-trash"></i>
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('admin.email.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
            <i class="fas fa-arrow-right"></i>
            بازگشت
        </a>
    @else
        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-sm text-slate-500">هیچ فایلی پیوست نشده است.</div>
        <a href="{{ route('admin.email.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
            <i class="fas fa-arrow-right"></i>
            بازگشت
        </a>
    @endif
</div>
