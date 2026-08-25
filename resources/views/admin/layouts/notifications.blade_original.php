@if(session('toast-success') || session('toast-error') || session('swal-success') || session('swal-error'))
    <section class="fixed bottom-4 left-4 z-[60] space-y-3">
        @if(session('toast-success'))
            <div class="flex w-[22rem] items-start gap-3 rounded-2xl border border-emerald-200 bg-white p-4 shadow-2xl shadow-emerald-950/10">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i class="fas fa-circle-check"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-slate-900">موفقیت</p>
                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ session('toast-success') }}</p>
                </div>
            </div>
        @endif

        @if(session('toast-error'))
            <div class="flex w-[22rem] items-start gap-3 rounded-2xl border border-rose-200 bg-white p-4 shadow-2xl shadow-rose-950/10">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-slate-900">خطا</p>
                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ session('toast-error') }}</p>
                </div>
            </div>
        @endif
    </section>

    @if(session('swal-success') || session('swal-error'))
        <script>
            $(document).ready(function () {
                @if(session('swal-success'))
                Swal.fire({
                    icon: "success",
                    title: "عملیات با موفقیت انجام شد",
                    text: @json(session('swal-success')),
                    confirmButtonText: 'باشه',
                });
                @endif

                @if(session('swal-error'))
                Swal.fire({
                    icon: "error",
                    title: "خطا!",
                    text: @json(session('swal-error')),
                    confirmButtonText: 'باشه',
                    footer: '<a href="/support">چطور حلش کنم؟</a>'
                });
                @endif
            });
        </script>
    @endif
@endif
