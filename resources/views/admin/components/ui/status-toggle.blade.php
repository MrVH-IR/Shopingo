@php
    $checked = $checked ?? false;
    $onChange = $onChange ?? null;
@endphp

<div class="inline-flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-2 ring-1 ring-inset ring-slate-200">
    <span class="text-xs font-semibold text-slate-500">وضعیت</span>
    <label class="relative inline-flex cursor-pointer items-center">
        <input
            id="{{ $id }}"
            onchange="{{ $onChange ?: 'changeStatus(\'' . $id . '\')' }}"
            type="checkbox"
            data-url="{{ $url }}"
            @checked($checked)
            class="peer sr-only"
        >
        <span class="h-6 w-11 rounded-full bg-slate-300 transition peer-checked:bg-cyan-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-cyan-100"></span>
        <span class="absolute right-[2px] h-5 w-5 rounded-full bg-white shadow-sm transition peer-checked:-translate-x-5"></span>
    </label>
</div>
