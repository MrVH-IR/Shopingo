<style>
    /* استایل لینک دانلود */
    .custom-download-link {
        color: #4338ca;
        background-color: #f0f4ff;
        border: 1px solid #d0d8f0;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        font-size: 0.875rem;
        height: 38px;
        line-height: 1;
    }

    .custom-download-link:hover {
        color: #3730a3 !important;
        background-color: #e5edff !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.15) !important;
    }

    /* استایل دکمه حذف — تطبیق با لینک */
    .delete-file-btn {
        height: 38px;
        width: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 0.875rem;
        line-height: 1;
        border: 1px solid #dc3545;
        background-color: white;
        color: #dc3545;
        transition: all 0.2s ease;
    }

    .delete-file-btn:hover {
        background-color: #dc3545;
        color: white !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    .delete-file-btn i {
        font-size: 0.9rem;
    }
</style>
<div class="mt-4">
    <h6>فایل‌های پیوست:</h6>
{{--    @dd($emailFiles)--}}

    @if($emailFiles->isNotEmpty())
        @foreach($emailFiles as $emailFile)
            <div class="d-flex align-items-center mb-3 gap-2">
                <x-files
                    href="{{ route('admin.email.file.download', $emailFile->id) }}"
                    title="{{ $emailFile->file_size_formatted ?? 'فایل' }}"
                >
                    {{ basename($emailFile->file_path) }}
                </x-files>
                <small class="text-muted mt-1">
                    Type: {{ strtoupper($emailFile->file_type) }} |
                    Size: {{ \App\Http\Services\File\FileToolsService::formatSize($emailFile->file_size) }}
                </small>

                <form
                    action="{{ route('admin.email.file.delete', $emailFile) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('آیا از حذف این فایل اطمینان دارید؟')"
                >
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="file_id" value="{{ $emailFile->id }}">
                    <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1 delete-file-btn">
                        <i class="bi bi-trash me-1"></i><span class="d-none d-sm-inline">حذف</span>
                    </button>
                </form>
            </div>
        @endforeach
            <a href="{{ route('admin.email.index') }}">بازگشت</a>
    @else
        <p class="text-muted">هیچ فایلی پیوست نشده است.</p>
        <a href="{{ route('admin.email.index') }}">بازگشت</a>
    @endif
</div>
