@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-8">
            <div class="card">
                <div class="card-body">
                    @foreach($cart->content as $productsSet)
                        <div class="products-set">
                            <span>Название: {{ $productsSet->product->name }}</span>
                            <span>Количество: {{ $productsSet->count }}</span>
                            <span>Цена: {{ $productsSet->totalPrice }}</span>
                        </div>
                    @endforeach
                    <span>Итоговая цена: {{ $cart->totalPrice() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
