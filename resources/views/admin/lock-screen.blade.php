<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه قفل شده</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-screen overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 font-['Vazirmatn']">
    <div class="pointer-events-none absolute right-10 top-10 h-72 w-72 animate-pulse rounded-full bg-amber-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-10 left-10 h-96 w-96 animate-pulse rounded-full bg-cyan-500/10 blur-3xl [animation-delay:2s]"></div>

    <main class="relative flex min-h-screen items-center justify-center px-4 py-8" x-data="{ showPassword: false }">
        <div class="animate__animated animate__fadeInUp w-full max-w-md">
            <div class="rounded-3xl border border-white/20 bg-white/10 p-8 shadow-2xl backdrop-blur-xl">
                <div class="mb-6 flex justify-center">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-amber-400 to-amber-600 shadow-lg shadow-amber-500/30">
                        <i class="fas fa-lock text-2xl text-white"></i>
                    </div>
                </div>

                <h1 class="text-center text-xl font-bold text-white">صفحه قفل شده است</h1>
                <p class="mt-2 text-center text-sm text-slate-300">برای ادامه، رمز عبور خود را وارد کنید</p>

                <div class="my-6 flex items-center justify-center gap-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-500/20 text-amber-400">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <span class="font-medium text-white">{{ auth()->user()->full_name }}</span>
                </div>

                <form method="POST" action="{{ route('lock-screen.unlock') }}" class="space-y-4">
                    @csrf
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password" autofocus class="w-full rounded-2xl border bg-white/5 px-4 py-3 pl-12 text-white placeholder:text-slate-400 outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-400/10 @error('password') border-rose-400 @else border-white/20 @enderror" placeholder="رمز عبور">
                        <button type="button" @click="showPassword = !showPassword" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-amber-400"><i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i></button>
                        @error('password')<p class="mt-2 flex items-center gap-1 text-xs text-rose-400"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-3 font-semibold text-white shadow-lg shadow-amber-500/20 transition hover:from-amber-600 hover:to-amber-700">
                        <i class="fas fa-unlock"></i><span>باز کردن قفل</span>
                    </button>
                </form>
            </div>
            <p class="mt-6 text-center text-xs text-slate-500">برای ورود مجدد باید هویت خود را تایید کنید</p>
        </div>
    </main>
</body>
</html>
