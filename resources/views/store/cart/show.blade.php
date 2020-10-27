@extends('layouts.store')

@section('content')
    <div class="container">
        <div class="row">
            @include('store.includes.recommend-product-column')
            <div class="col-md-8">
                <order-form :cart-items-sets="{{ $cart->content->values()->toJson() }}"
                            store-order-url="{{ route('store.order.store') }}"></order-form>
            </div>
        </div>
    </div>
@endsection
