@extends('informations.master')

@section('content')
    <div class="container mx-auto py-20">

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8">
            <div class="group rounded-3xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 p-6">
                <img
                    src="{{ asset('websiteImages/me.jpeg') }}"
                    class="w-24 h-24 rounded-full mx-auto border-4 border-blue-600 object-cover">
                <h3 class="text-xl font-bold text-center mt-5">
                    Mohammad Reza Vahdat
                </h3>
                <p class="text-center text-gray-500 dark:text-gray-400">
                    Laravel Backend Developer
                </p>
                <p class="text-center mt-2 text-sm text-blue-600">
                    linkedin.com/in/mohammad-reza-vahdat
                </p>
                <a
                    href="https://linkedin.com/in/mohammad-reza-vahdat-0b2608398"
                    target="_blank"
                    class="mt-6 flex items-center justify-center gap-2 rounded-xl bg-[#0A66C2] py-3 text-white font-semibold hover:scale-105 transition">

                    <i class="fab fa-linkedin text-xl"></i>
                    View Profile
                </a>
            </div>

            <div class="group rounded-3xl bg-white dark:bg-gray-800 shadow-lg p-6">
                <img
                    src="{{ asset('websiteImages/175750251.jpeg') }}"
                    class="w-24 h-24 rounded-full mx-auto object-cover">
                <h3 class="text-xl font-bold text-center mt-5">
                    Mohammad Reza Vahdat
                </h3>
                <p class="text-center text-gray-500">
                    Open Source & Laravel
                </p>
                <a
                    href="https://github.com/MrVH-IR"
                    target="_blank"
                    class="mt-6 flex justify-center items-center gap-3 bg-black text-white py-3 rounded-xl">
                    <i class="fab fa-github text-xl"></i>
                    GitHub
                </a>
            </div>

            <a
                href="https://instagram.com/koorosh_vh"
                target="_blank"
                class="group rounded-3xl bg-gradient-to-br from-pink-500 via-red-500 to-yellow-400 p-[2px] block">
                <div class="rounded-3xl bg-white dark:bg-gray-900 p-6">
                    <img
                        src="{{ asset('websiteImages/me.jpeg') }}"
                        class="w-24 h-24 rounded-full mx-auto">
                    <h3 class="text-center text-xl font-bold mt-5">
                        Mohammad Reza
                    </h3>
                    <p class="text-center text-gray-500">
                        @Koorosh_vh
                    </p>
                </div>
            </a>

            <a
                href="https://t.me/MrVH0"
                target="_blank"
                class="rounded-3xl bg-[#229ED9] text-white p-6 block">
                <img
                    src="{{ asset('websiteImages/me.jpeg') }}"
                    class="w-24 h-24 rounded-full mx-auto border-4 border-white">
                <h3 class="text-center text-xl font-bold mt-5">
                    Mohammad Reza
                </h3>
                <p class="text-center opacity-90">
                    @MrVH0
                </p>
            </a>

        </div>
    </div>
@endsection
