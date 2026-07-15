<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>صفحه قفل شده</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        .floating-delay {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-slate-950 flex items-center justify-center relative overflow-hidden">

{{-- المان‌های نوری پس‌زمینه --}}
<div class="absolute top-10 right-10 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl floating"></div>
<div class="absolute bottom-10 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl floating-delay"></div>

<div class="relative w-full max-w-md mx-4" x-data="{ showPassword: false }">
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl p-8">

        {{-- آیکون قفل --}}
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30">
                <i class="fa-solid fa-lock text-white text-2xl"></i>
            </div>
        </div>

        <h4 class="text-center text-xl font-bold text-white mb-1">
            صفحه قفل شده است
        </h4>
        <p class="text-center text-gray-300 text-sm mb-1">
            برای ادامه، رمز عبور خود را وارد کنید
        </p>

        {{-- نام کاربر --}}
        <div class="flex items-center justify-center gap-2 mt-4 mb-6">
            <div class="w-9 h-9 rounded-full bg-amber-500/20 flex items-center justify-center">
                <i class="fa-solid fa-user text-amber-400 text-sm"></i>
            </div>
            <span class="text-white font-medium">{{ auth()->user()->full_name }}</span>
        </div>

        <form method="POST" action="{{ route('lock-screen.unlock') }}" class="space-y-4">
            @csrf

            <div class="relative">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    autofocus
                    class="w-full bg-white/5 border @error('password') border-red-400 @else border-white/20 @enderror rounded-xl px-4 py-3 pl-12 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition"
                    placeholder="رمز عبور">

                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-400 transition">
                    <i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>

                @error('password')
                <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-amber-500/20 transition duration-200">
                <i class="fa-solid fa-unlock"></i>
                <span>باز کردن قفل</span>
            </button>
        </form>
    </div>

    <p class="text-center text-gray-500 text-xs mt-6">
        برای ورود مجدد باید هویت خود را تایید کنید
    </p>
</div>

</body>
</html>
