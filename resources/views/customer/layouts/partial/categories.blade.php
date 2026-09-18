<nav class="space-y-1">
    @foreach($categories as $category)
        @if($category->children->count() > 0)
            <details class="group">
                <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-3 py-2.5 transition-all duration-200 hover:bg-slate-50">
                    <a
                        href="{{ route('customer.home') }}"
                        onclick="event.stopPropagation()"
                        class="flex min-w-0 flex-1 items-center gap-2 text-sm font-medium text-slate-600 transition-colors duration-200 hover:text-slate-900"
                    >
                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-slate-300 transition-all duration-200 group-hover:bg-indigo-500"></span>
                        <span class="truncate">
                            {{ $category->name }}
                        </span>
                    </a>
                    <span class="mr-2 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-slate-400 transition-all duration-200 group-hover:bg-slate-100 group-hover:text-slate-600">
                        <i class="fa fa-angle-left text-xs transition-transform duration-200 group-open:-rotate-90"></i>
                    </span>
                </summary>
                @include('customer.layouts.partial.sub-categories', [
                    'categories' => $category->children
                ])
            </details>
        @else
            <a
                href="{{ route('customer.home') }}"
                class="group flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:text-slate-900"
            >
                <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-slate-300 transition-all duration-200 group-hover:bg-indigo-500"></span>
                <span class="truncate">
                    {{ $category->name }}
                </span>
            </a>
        @endif
    @endforeach
</nav>
