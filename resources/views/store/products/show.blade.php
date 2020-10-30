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
                                <img src="{{ asset($product->thumbnail_path) }}" alt="">
                            </div>
                            <div class="price">
                                {{ $product->getPriceWithSymbol() }}
                            </div>
                            <div class="description">
                                {{ $product->description }}
                            </div>
                            <add-product-form csrf-token="{{ csrf_token() }}"
                                              :product="{{ $product->toJson() }}"
                                              cart-add-route="{{ route('store.cart.add') }}"
                                              initial-product-count="{{ $currentProductCountInCart }}"></add-product-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
