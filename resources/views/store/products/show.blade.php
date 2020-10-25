@php
/**
 * @var \App\Models\Product $product
 */
@endphp
@extends('layouts.store')

@section('content')
    <div class="container">
        <div class="row">
            @include('store.includes.recommend-product-column')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="product">
                            <div class="product-image-wrapper">
                                <img src="{{ asset('storage/test-images/' . $product->thumbnail_path) }}" alt="">
                            </div>
                            <div class="price">
                                {{ $product->getPriceWithSymbol() }}
                            </div>
                            <div class="description">
                                {{ $product->description }}
                            </div>
                            @include('store.includes.add-in-cart-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection