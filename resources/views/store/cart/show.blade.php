@extends('layouts.store')

@section('content')
    <div class="container">
        <div class="row">
            @include('store.includes.recommend-product-column')
            <div class="col-md-8">
                <order-form :cart-items-sets="{{ $cart->content->values()->toJson() }}"
                            order-create-url="{{ route('store.order.create') }}"></order-form>
            </div>
        </div>
    </div>
@endsection
