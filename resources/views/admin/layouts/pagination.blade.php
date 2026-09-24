@if ($paginator->hasPages())
    <nav class="flex items-center justify-between border-t border-slate-200 bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-slate-600">
                نمایش
                <span class="font-semibold text-slate-900">{{ $paginator->firstItem() }}</span>
                تا
                <span class="font-semibold text-slate-900">{{ $paginator->lastItem() }}</span>
                از
                <span class="font-semibold text-slate-900">{{ $paginator->total() }}</span>
                {{ $title }}
            </p>
        </div>

        <div class="flex items-center gap-1">
            @if ($paginator->onFirstPage())
                <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-300">
                    <i class="fas fa-chevron-right text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <i class="fas fa-chevron-right text-xs"></i>
                </a>
            @endif

            @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="flex h-9 min-w-9 items-center justify-center rounded-lg bg-slate-900 px-3 text-sm font-semibold text-white">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" class="flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
            @else
                <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-300">
                    <i class="fas fa-chevron-left text-xs"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
