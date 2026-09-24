<section class="position-relative sublist-area">
    @foreach($categories as $category)
        <section class="sublist-item">
            <section class="sublist-item-toggle">
                {{ $category->name }}
            </section>
            @if($category->children->isNotEmpty())
                <section class="sublist-item-sublist">
                    <section class="sublist-item-sublist-wrapper d-flex justify-content-around align-items-center">
                        @foreach($category->children->chunk(ceil($category->children->count() / 4)) as $column)
                            <section class="sublist-column col">
                                @foreach($column as $child)
                                    @include('customer.layouts.header.category-item', ['category' => $child])
                                @endforeach
                            </section>
                        @endforeach
                    </section>
                </section>
            @endif
        </section>
    @endforeach
</section>
