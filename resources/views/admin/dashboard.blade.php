@extends('admin.layouts.store')

@section('content')
    <main class="content">
        <div class="content-container">
            <div class="col col-3">
                <div class="col-content">
                    <h3 class="title">Самые продаваемые товары</h3>
                    <ul class="more-sale-products">
                        <li class="more-sale-products__item">
                            <a href="#" class="more-sale-products__name">Some name</a>
                            <span class="more-sale-products__sales">123</span>
                            <span class="more-sale-products__rest">1234</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col col-3">
                <div class="col-content">
                    <h3 class="title">Самые просматриваемые товары</h3>
                    <ul class="more-view-products">
                        @foreach($popularProducts as $product)
                        <li class="more-view-products__item">
                            <a href="{{ $product->getShowRoute() }}" class="more-view-products__name">
                                {{ $product->name }}
                            </a>
                            <span class="more-view-products__views">{{ $product->views_count }}</span>
                            <span class="more-view-products__rest">{{ $product->restCount }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col col-3">
                <div class="col-content">
                    <h3 class="title">Самые просматриваемые товары за сегодня</h3>
                    <ul class="more-view-products">
                        @foreach($popularTodayProducts as $product)
                        <li class="more-view-products__item">
                            <a href="{{ $product->getShowRoute() }}" class="more-view-products__name">
                                {{ $product->name }}
                            </a>
                            <span class="more-view-products__views">{{ $product->views_count }}</span>
                            <span class="more-view-products__rest">{{ $product->restCount }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
