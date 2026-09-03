@extends('informations.master')

@section('content')
    <section class="py-24 relative" dir="rtl">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
            <div class="w-full flex-col justify-center items-center gap-10 inline-flex">
                <div class="w-full flex-col justify-center items-start gap-4 flex">
                    <h6 class="text-gray-400 text-base font-normal leading-relaxed">سوالات متداول</h6>
                    <div class="w-full flex-col justify-center items-start gap-3 flex">
                        <h2
                            class="text-indigo-700 text-4xl font-bold font-manrope leading-normal lg:text-start text-center">
                            پاسخ سوالات رایج شما
                        </h2>
                        <p
                            class="text-gray-500 text-base font-normal leading-relaxed lg:text-start text-center">
                            پاسخ‌های رایج‌ترین سوالات کاربران درباره شاپینگو را در اینجا پیدا کنید. اگر سوال دیگری دارید با ما در تماس باشید.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 w-full max-w-3xl mx-auto">
                <div class="space-y-4" id="faq-accordion">
                    @foreach($faqs as $faq)
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <button type="button"
                                    class="faq-toggle w-full px-6 py-4.5 flex items-center justify-between text-right focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                                    aria-expanded="false"
                                    aria-controls="faq-content-{{ $loop->index }}"
                                    data-faq-index="{{ $loop->index }}">
                                <h3 class="text-gray-900 dark:text-white text-lg font-semibold leading-relaxed pr-4">
                                    {{ $faq->question }}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="faq-content-{{ $loop->index }}"
                                 class="faq-content hidden px-6 pb-4.5"
                                 role="region"
                                 aria-labelledby="faq-toggle-{{ $loop->index }}">
                                <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                                    <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed">
                                        {!! $faq->answer !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($faqs->hasPages())
                    <div class="mt-8 flex justify-center">
                        <nav class="flex items-center gap-2" aria-label="Pagination">
                            @if($faqs->onFirstPage())
                                <button type="button" disabled
                                        class="px-3 py-1.5 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 rounded-lg cursor-not-allowed">
                                    قبلی
                                </button>
                            @else
                                <a href="{{ $faqs->previousPageUrl() }}"
                                   class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    قبلی
                                </a>
                            @endif

                            @foreach($faqs->getUrlRange(1, $faqs->lastPage()) as $page => $url)
                                @if($page == $faqs->currentPage())
                                    <span class="px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            @if($faqs->hasMorePages())
                                <a href="{{ $faqs->nextPageUrl() }}"
                                   class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    بعدی
                                </a>
                            @else
                                <button type="button" disabled
                                        class="px-3 py-1.5 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 rounded-lg cursor-not-allowed">
                                    بعدی
                                </button>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-24 relative bg-gray-50 dark:bg-gray-800/50">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
            <div class="w-full flex-col justify-center items-center gap-10 inline-flex">
                <div class="w-full flex-col justify-center items-start gap-4 flex">
                    <div class="flex-col justify-start lg:items-start items-center gap-4 flex">
                        <h2
                            class="text-gray-900 dark:text-white text-3xl font-bold font-manrope leading-normal lg:text-start text-center">
                            سوالی دارید؟ با ما در تماس باشید
                        </h2>
                        <p
                            class="text-gray-500 dark:text-gray-400 text-base font-normal leading-relaxed lg:text-start text-center">
                            اگر پاسخ سوال شما را نیافتد، تیم پشتیبانی ما در خدمت شماست
                        </p>
                    </div>
                    <a href="{{ url('/contact-us') }}"
                       class="sm:w-fit w-full group px-3.5 py-2 bg-indigo-600 hover:bg-indigo-800 transition-all duration-300 ease-in-out rounded-lg shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex">
                        <span class="px-1.5 text-white text-sm font-medium leading-6">تماس با پشتیبانی</span>
                        <svg class="group-hover:translate-x-0.5 transition-all duration-300 ease-in-out ml-2"
                             xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M6.75265 4.49658L11.2528 8.99677L6.75 13.4996" stroke="#ffffff" stroke-width="1.6"
                                  stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.faq-toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const index = this.dataset.faqIndex;
                const content = document.getElementById('faq-content-' + index);
                const icon = this.querySelector('svg');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                this.setAttribute('aria-expanded', !isExpanded);
                content.classList.toggle('hidden');

                if (!isExpanded) {
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                }
            });

            toggle.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
    });
</script>
@endpush
