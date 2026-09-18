<div class="mr-4 border-r border-slate-100 pr-2">
    <div class="mt-1 space-y-0.5">
        @foreach($categories as $category)
            @if($category->children->count() > 0)
                <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between rounded-lg px-3 py-2 transition-all duration-200 hover:bg-slate-50">
                        <a
                            href="{{ route('customer.home') }}"
                            onclick="event.stopPropagation()"
                            class="flex min-w-0 flex-1 items-center gap-2 text-[13px] text-slate-500 transition-colors duration-200 hover:text-slate-800"
                        >
                            <span class="h-1 w-1 shrink-0 rounded-full bg-slate-300 transition-colors duration-200 group-hover:bg-indigo-400"></span>
                            <span class="truncate">
                                {{ $category->name }}
                            </span>
                        </a>
                        <span class="mr-2 flex h-6 w-6 shrink-0 items-center justify-center rounded-md text-slate-300 transition-all duration-200 group-hover:bg-slate-100 group-hover:text-slate-500">
                            <i class="fa fa-angle-left text-[10px] transition-transform duration-200 group-open:-rotate-90"></i>
                        </span>
                    </summary>
                    @include('customer.layouts.partial.sub-categories', [
                        'categories' => $category->children
                    ])
                </details>
            @else
                <a
                    href="{{ route('customer.home') }}"
                    class="group flex items-center gap-2 rounded-lg px-3 py-2 text-[13px] text-slate-500 transition-all duration-200 hover:bg-slate-50 hover:text-slate-800"
                >
                    <span class="h-1 w-1 shrink-0 rounded-full bg-slate-300 transition-colors duration-200 group-hover:bg-indigo-400"></span>

                    <span class="truncate">
                        {{ $category->name }}
                    </span>
                </a>
            @endif
        @endforeach
    </div>
</div>
