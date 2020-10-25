@extends('layouts.store')

@section('content')
<div class="container">
    @include('store.includes.alert')
    <div class="row justify-content-center">
        @include('store.includes.recommend-product-column')
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="products-list">
                        @foreach($popularProductsPaginate as $product)
                            @php /** @var \App\Models\Product $product **/ @endphp
                            <div class="product-item">
                                <div class="top">
                                    <a class="name" href="{{ $product->getShowRoute() }}">
                                        {{ $product->name }}
                                    </a>
                                    <span class="price">
                                        {{ $product->getPriceWithSymbol() }}
                                    </span>
                                </div>
                                <img src="{{ asset('storage/test-images/' . $product->thumbnail_path)  }}" alt="" class="product-thumbnail-big">
                                <div class="description">
                                    {{ $product->short_description }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {{ $popularProductsPaginate->links() }}
    </div>
</div>
@endsection
