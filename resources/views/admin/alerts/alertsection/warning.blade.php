@if(session('alert-section-warning'))
    <div class="relative overflow-hidden rounded-2xl border border-amber-200 bg-amber-50 p-4 text-amber-800" role="alert">
        <button type="button" class="absolute left-3 top-3 inline-flex h-8 w-8 items-center justify-center rounded-full text-amber-600 transition hover:bg-white/70" onclick="this.parentElement.remove()" aria-label="بستن">
            <i class="fas fa-xmark"></i>
        </button>
        <div class="flex items-start gap-3 pl-10">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/70 text-amber-600">
                <i class="fas fa-triangle-exclamation"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold">هشدار</h4>
                <p class="mt-1 text-sm leading-6">{{ session('alert-section-warning') }}</p>
            </div>
        </div>
    </div>
@endif
