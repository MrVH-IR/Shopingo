@foreach($productCategory->children as $child)
    <option value="{{ $child->id }}" @selected(old('parent_id', ) == $child->id)>{{ $child->name }}</option>
    @if($child->children->isNotEmpty())
        @include('admin.market.category.create-menu', ['productCategory' => $child])
    @endif
@endforeach
