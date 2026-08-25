@php
    $title = $title ?? '';
    $description = $description ?? null;
    $breadcrumbs = $breadcrumbs ?? [];
    $actionUrl = $actionUrl ?? null;
    $actionLabel = $actionLabel ?? null;
    $actionIcon = $actionIcon ?? 'fas fa-plus';
    $actionDisabled = $actionDisabled ?? false;
@endphp

<section class="overflow-hidden animate__animated animate__fadeIn rounded-3xl border border-slate-200 bg-white shadow-sm">
    <div class="relative isolate overflow-hidden px-6 py-7 sm:px-8">
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900"></div>
        <div class="absolute right-0 top-0 -z-10 h-40 w-40 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 -z-10 h-32 w-32 rounded-full bg-fuchsia-400/10 blur-3xl"></div>

        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl">
                <nav aria-label="breadcrumb" class="mb-3 flex flex-wrap items-center gap-2 text-sm text-slate-300">
                    @foreach($breadcrumbs as $index => $breadcrumb)
                        @if($index > 0)
                            <span class="text-slate-500">/</span>
                        @endif
                        @if(!empty($breadcrumb['url']))
                            <a href="{{ $breadcrumb['url'] }}" class="transition hover:text-white">{{ $breadcrumb['label'] }}</a>
                        @else
                            <span class="text-slate-100">{{ $breadcrumb['label'] }}</span>
                        @endif
                    @endforeach
                </nav>

                <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">{{ $title }}</h1>
                @if($description)
                    <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">{{ $description }}</p>
                @endif
            </div>

            @if($actionUrl || $actionDisabled)
                @if($actionDisabled)
                    <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-2xl bg-white/10 px-4 py-3 text-sm font-semibold text-slate-400 ring-1 ring-inset ring-white/10">
                        <i class="{{ $actionIcon }}"></i>
                        {{ $actionLabel }}
                    </span>
                @else
                    <a href="{{ $actionUrl }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="{{ $actionIcon }} text-cyan-700"></i>
                        {{ $actionLabel }}
                    </a>
                @endif
            @endif
        </div>
    </div>
</section>
