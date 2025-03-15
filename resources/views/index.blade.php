@extends('layouts.master')

@section("content")
<div class="container mx-auto p-6 space-y-12">
    <!-- First Div -->
    <section id="first-div">
        <h2 class="text-2xl font-bold text-blue-600 mb-4">First Div</h2>
        <div class="relative overflow-hidden group">
            <div id="first-carousel" class="flex space-x-6 animate-carousel">
                @foreach($first_div as $product)
                    <div class="flex-shrink-0 w-48 h-56 bg-white shadow-lg rounded-lg p-4 text-center transition-transform duration-700 ease-in-out">
                        <!-- Circle Image -->
                        @if ($product->image_uri)
                            <img src="{{ asset('storage/' . $product->image_uri) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-full mx-auto mb-4">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <span class="text-sm text-gray-500">No Image</span>
                            </div>
                        @endif
                        <!-- Product Description -->
                        <p class="text-sm text-gray-600">{{ Str::limit($product->description, 50) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Second Div -->
    <section id="second-div">
        <h2 class="text-2xl font-bold text-green-600 mb-4">Second Div</h2>
        <div class="relative overflow-hidden group">
            <div id="second-carousel" class="flex space-x-6 animate-carousel">
                @foreach($second_div as $product)
                    <div class="flex-shrink-0 w-48 h-56 bg-white shadow-lg rounded-lg p-4 text-center transition-transform duration-700 ease-in-out">
                        <!-- Circle Image -->
                        @if ($product->image_uri)
                            <img src="{{ asset('storage/' . $product->image_uri) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-full mx-auto mb-4">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <span class="text-sm text-gray-500">No Image</span>
                            </div>
                        @endif
                        <!-- Product Description -->
                        <p class="text-sm text-gray-600">{{ Str::limit($product->description, 50) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Third Div -->
    <section id="third-div">
        <h2 class="text-2xl font-bold text-red-600 mb-4">Third Div</h2>
        <div class="relative overflow-hidden group">
            <div id="third-carousel" class="flex space-x-6 animate-carousel">
                @foreach($third_div as $product)
                    <div class="flex-shrink-0 w-48 h-56 bg-white shadow-lg rounded-lg p-4 text-center transition-transform duration-700 ease-in-out">
                        <!-- Circle Image -->
                        @if ($product->image_uri)
                            <img src="{{ asset('storage/' . $product->image_uri) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-full mx-auto mb-4">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <span class="text-sm text-gray-500">No Image</span>
                            </div>
                        @endif
                        <!-- Product Description -->
                        <p class="text-sm text-gray-600">{{ Str::limit($product->description, 50) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
