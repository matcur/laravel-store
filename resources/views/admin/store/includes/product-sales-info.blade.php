<div class="card card-body">
    <div class="products-info">
        <div class="sold">
            {{ $page->productSalesInfo->count() }}
        </div>
        <ul class="populars">
            @foreach($page->productSalesInfo->populars() as $popular)
                <li class="populars__item">
                    {{ "{$popular->name()} {$populars->count()}" }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
