<a href="{{ route('products.products', $category->id) }}" class="sub-category">
    {{ $category->name }}
</a>
@if($category->children->isNotEmpty())
    @foreach($category->children as $child)
        <a href="{{ route('products.products', $child->id) }}" class="sub-sub-category">
            {{ $child->name }}
        </a>
        @if($child->children->isNotEmpty())
            @include('customer.layouts.header.category-item', ['category' => $child])
        @endif
    @endforeach
@endif
