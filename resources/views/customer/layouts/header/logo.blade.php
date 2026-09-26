<section class="flex-shrink-0 ml-5">
    <a
        href="{{ route('customer.home') }}"
        class="flex items-center gap-3 group text-decoration-none">
        <div
            class="relative w-14 h-14 rounded-2xl bg-gradient-to-br  shadow-lg flex items-center justify-center overflow-hidden">
            <div
                id="logo-spinner"
                class="spinner-border spinner-border-sm text-white position-absolute"
                role="status">
            </div>
            @if($settings?->logo)
                <img
                    id="logo-image"
                    src="{{ asset($settings?->logo) }}"
                    alt="Logo"
                    class="hidden w-11 h-11 object-contain rounded-lg">
            @else
                <img
                    id="logo-image"
                    src="{{ asset('customer-assets/images/logo/android-chrome-512x512.png') }}"
                    alt="Logo"
                    class="hidden w-11 h-11 object-contain rounded-lg">
            @endif
        </div>
        <div class="hidden lg:block">
            <h1
                class="text-xl font-black text-gray-800 group-hover:text-blue-600 transition">
                {{ config('app.app_english_name') }}
            </h1>
            <p
                class="text-xs text-gray-500">
                فروشگاه اینترنتی
            </p>
        </div>
    </a>
</section>
