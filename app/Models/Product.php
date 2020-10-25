<?php

namespace App\Models;

use App\Store\Contracts\Models\HasImages;
use App\Store\Contracts\Models\HasShowRoute;
use App\Store\Contracts\Models\HasViews;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements HasShowRoute, HasViews, HasImages
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'currency_id',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function scopePopulars(Builder $query)
    {
        return $query->withCount('views')
            ->orderBy('views_count', 'desc');
    }

    //Добавил, чтобы избавиться от float в базе данных
    //https://dev.mysql.com/doc/refman/8.0/en/problems-with-float.html
    public function getPriceAttribute(): float
    {
        return $this->attributes['price'] / 100;
    }

    public function setPriceAttribute(int $value): self
    {
        $this->attributes['price'] = $value * 100;

        return $this;
    }

    function getShowRoute(): string
    {
        $routeKey = $this->getRouteKey();

        return route('store.products.show', $routeKey);
    }

    public function getPriceWithSymbol()
    {
        return $this->price . ' ' . $this->currency->symbol;
    }

    public static function getPopularsPaginate($perPage = 10)
    {
        return self::populars()->with('currency')->paginate($perPage);
    }
}
