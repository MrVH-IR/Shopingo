@extends('layouts.master')



@section("content")

<div id="first-div">
    @foreach($first_div as $product)
        <p>{{ $product->id }}: {{ $product->first_div }}</p>
    @endforeach
</div>

<div id="second-div">
    @foreach($second_div as $product)
        <p>{{ $product->id }}: {{ $product->second_div }}</p>
    @endforeach
</div>

<div id="third-div">
    @foreach($third_div as $product)
        <p>{{ $product->id }}: {{ $product->third_div }}</p>
    @endforeach
</div>


@endsection
