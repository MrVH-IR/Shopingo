<div class="p-4">
    {{-- پیشنهادها --}}
    <div>
        <h6 class="text-sm font-bold text-gray-700 mb-3">
            جستجوهای پیشنهادی
        </h6>
        <div class="space-y-1">
            @foreach ([
                        ['name' => 'آیفون', 'icon' => 'fa-solid fa-mobile-screen-button', 'tone' => 'bg-rose-50 text-rose-600'],
                        ['name' => 'لپ تاپ', 'icon' => 'fa-solid fa-laptop', 'tone' => 'bg-sky-50 text-sky-600'],
                        ['name' => 'هدفون', 'icon' => 'fa-solid fa-headphones-simple', 'tone' => 'bg-emerald-50 text-emerald-600'],
                        ]
            as $item)
                <button
                    type="button"
                    @click="choose(@js($item['name']))"
                    class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition text-right"
                >
                    <span class="w-8 h-8 flex items-center justify-center rounded-full {{ $item['tone'] }} text-sm">
                        <i class="{{ $item['icon'] }}"></i>
                    </span>
                    <span class="flex-1">
                        {{ $item['name'] }}
                    </span>
                    <i class="fas fa-search text-gray-300 text-xs"></i>
                </button>
            @endforeach
        </div>
    </div>
    <hr class="my-4">
    {{-- تاریخچه --}}
    <div>
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-bold text-gray-700">
                آخرین جستجوها
            </span>
            <button
                x-show="history.length"
                type="button"
                @click="clearHistory()"
                class="text-xs text-red-500 hover:text-red-700"
            >
                پاک کردن
            </button>
        </div>
        <template x-if="history.length === 0">
            <p class="text-center text-sm text-gray-400 py-3">
                هنوز جستجویی انجام نشده است.
            </p>
        </template>
        <template x-for="item in history" :key="item">
            <button
                type="button"
                @click="choose(item)"
                class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition text-right"
            >
                <i class="fas fa-history text-gray-400"></i>
                <span
                    class="flex-1"
                    x-text="item">
                </span>
            </button>
        </template>
    </div>
</div>
