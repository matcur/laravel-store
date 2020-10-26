@extends('layouts.store')

@section('content')
    <div class="container">
        <div class="row">
            @include('store.includes.recommend-product-column')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="cart">
                            @if(count($cart->content) == 0)
                                <div class="cart-empty">
                                    Корзина пуста
                                </div>
                            @else
                                @foreach($cart->content as $buyableSet)
                                    <div class="cart-item">
                                        <div class="image-wrapper">
                                            <img src="{{ asset('storage/test-images/' . $buyableSet->product->thumbnail_path) }}" alt="">
                                        </div>
                                        <div class="info">
                                            <div class="short_description">{{ $buyableSet->product->short_description }}</div>
                                            <div class="price">{{ 'One item price: ' . $buyableSet->product->getPriceWithSymbol() }}</div>
                                            <div class="total-price">{{ 'A set price: ' . $buyableSet->getTotalPriceWithSymbol() }}</div>
                                        </div>
                                    </div>
                                @endforeach
                                <br>
                                {{ 'Total price: ' . $cart->totalPrice() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
