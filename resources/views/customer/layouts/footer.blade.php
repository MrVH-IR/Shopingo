<!-- start footer -->
<footer class="bg-white border-t border-gray-100">
    <section class="max-w-screen-xl mx-auto px-4 py-10">

        {{-- Trust / service features --}}
        <section class="grid grid-cols-2 md:grid-cols-5 gap-6 pb-10 border-b border-gray-100">
            <section class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('customer-assets/images/footer/Express.png') }}" alt="تحویل اکسپرس" class="h-10 w-10 object-contain">
                <span class="text-sm text-gray-600">امکان تحویل اکسپرس</span>
            </section>
            <section class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('customer-assets/images/footer/PayOnReceive.png') }}" alt="پرداخت در محل" class="h-10 w-10 object-contain">
                <span class="text-sm text-gray-600">امکان پرداخت در محل</span>
            </section>
            <section class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('customer-assets/images/footer/Support24x7.png') }}" alt="پشتیبانی ۲۴ ساعته" class="h-10 w-10 object-contain">
                <span class="text-sm text-gray-600">۷ روز هفته، ۲۴ ساعته</span>
            </section>
            <section class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('customer-assets/images/footer/7DayGuarantee.png') }}" alt="ضمانت بازگشت" class="h-10 w-10 object-contain">
                <span class="text-sm text-gray-600">۷ روز ضمانت بازگشت کالا</span>
            </section>
            <section class="flex flex-col items-center text-center gap-2 col-span-2 md:col-span-1">
                <img src="{{ asset('customer-assets/images/footer/OriginalProductGuarantee.png') }}" alt="ضمانت اصالت کالا" class="h-10 w-10 object-contain">
                <span class="text-sm text-gray-600">ضمانت اصل بودن کالا</span>
            </section>
        </section>

        {{-- Links + social --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 py-10">

            <section>
                <h3 class="text-gray-900 font-bold mb-3">راهنما و پشتیبانی</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/privacy-policy') }}" class="text-gray-500 hover:text-gray-800 transition-colors">شرایط و قوانین</a></li>
                    <li><a href="{{ url('/about-us') }}" class="text-gray-500 hover:text-gray-800 transition-colors">درباره ما</a></li>
                    <li><a href="{{ url('/contact-us') }}" class="text-gray-500 hover:text-gray-800 transition-colors">تماس با ما</a></li>
                    <li><a href="{{ url('/partnership') }}" class="text-gray-500 hover:text-gray-800 transition-colors">فرصت‌های شغلی</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-gray-800 transition-colors">سوالات متداول</a></li>
                </ul>
            </section>

            <section class="md:col-span-2">
                <h3 class="text-gray-900 font-bold mb-3">با ما همراه باشید</h3>
                <section class="flex items-center gap-5 text-xl">
                    <a href="#" aria-label="اینستاگرام" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="تلگرام" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fab fa-telegram"></i></a>
                    <a href="#" aria-label="واتساپ" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" aria-label="توییتر" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="لینکدین" class="text-gray-400 hover:text-gray-700 transition-colors"><i class="fab fa-linkedin"></i></a>
                </section>
            </section>

        </section>

        {{-- Company blurb --}}
        <section class="py-6 border-t border-gray-100">
            <h3 class="text-gray-900 font-bold mb-2">شرکت شاپینگو</h3>
            <p class="text-gray-500 leading-7 text-sm max-w-3xl">
                ما همواره تلاش می‌کنیم بهترین خدمات را به مشتریان آمازون ارائه کنیم. به شما کمک می‌کنیم بهترین انتخاب را داشته باشید و با اطمینان خاطر خرید را انجام بدهید و در کوتاه‌ترین زمان ممکن کالای خود را دریافت کنید. همچنین ما ۲۴ ساعته در هفت روز هفته به مشتریان‌مان خدمات ارائه می‌دهیم و ۷ روز ضمانت برگشت برای تمامی کالاها داریم.
            </p>
        </section>

        {{-- Copyright --}}
        <section class="pt-6 border-t border-gray-100">
            <p class="text-center text-sm text-gray-400">کلیه حقوق این وبسایت متعلق به شرکت شاپینگو می‌باشد.</p>
        </section>

    </section>
</footer>
<!-- end footer -->
