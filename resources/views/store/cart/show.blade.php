@extends('layouts.store')

@section('content')
    <div class="container">
        <div class="row">
        @include('store.includes.recommend-product-column')
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="cart">
                        @if(count($cart->items) == 0)
                            <div class="cart-empty">
                                Корзина пуста
                            </div>
                        @else
                            @foreach($cart->items as $productsSet)
                                @php
                                    /**
                                      * @var \App\Store\Cart\ProductsSet $productsSet
                                      * @var \App\Models\Product $product
                                     */
                                      $product = $productsSet->product;
                                @endphp
                                <div class="cart-item">
                                    <div class="image-wrapper">
                                        <img src="{{ asset('storage/test-images/' . $product->thumbnail_path) }}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="short_description">{{ $product->short_description }}</div>
                                        <div class="price">{{ 'One item price: ' . $product->getPriceWithSymbol() }}</div>
                                        <div class="total-price">{{ 'A set price: ' . $productsSet->getTotalPriceWithSymbol() }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <br>
                            {{ 'Total price: ' . $cart->getTotalPrice() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
