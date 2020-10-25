<form action="{{ route('store.cart.add') }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label for="{{ "product-{$product->id}-count" }}">Product count</label>
    <input type="number" name="count" id="{{ "product-{$product->id}-count" }}">
    <button class="btn btn-secondary">
        Add in cart
    </button>
</form>
