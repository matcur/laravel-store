@php
/**
 * @var \App\Models\Product $product
 */
@endphp
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="recommend-products-list">
                @foreach($recommendProducts as $product)
                    <div class="recommend-product-item">
                        <img src="{{ asset($product->thumbnail_path) }}" alt="" class="product-thumbnail-small">
                        <div class="bottom">
                            <a class="name" href="{{ $product->getShowRoute() }}">
                                {{ $product->name }}
                            </a>
                            <span class="price">
                                {{ $product->getPriceWithSymbol() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
