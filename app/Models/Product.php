<?php

namespace App\Models;

use App\Store\Contracts\Models\Imageable;
use App\Store\Contracts\Models\HasShowRoute as HasShowRouteContract;
use App\Store\Contracts\Models\Viewable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasShowRoute;

class Product extends Model implements HasShowRouteContract, Viewable, Imageable
{
    use HasFactory;
    use HasShowRoute;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'currency_id',
        'price',
    ];

    protected string $showRouteName = 'store.products.show';

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

    public static function scopePopular(Builder $query)
    {
        return $query->withCount('views')
            ->orderBy('views_count', 'desc');
    }

    public static function scopePopularInTime(Builder $query, Carbon $time)
    {
        return $query->withCount(['views' => function(Builder $q) use ($time) {
            $q->where('views.created_at', '>', $time);
        }])
            ->orderBy('views_count', 'desc');
    }

    public static function scopePopularToday(Builder $query)
    {
        return $query->popularInTime(today());
    }

    public static function getPopular(?int $limit = null)
    {
        return Product::popular()
            ->when(!is_null($limit), function (Builder $q) use ($limit) {
                $q->limit($limit);
            })
            ->get();
    }

    public static function getPopularToday(?int $limit = null)
    {
        return Product::popularToday()
            ->when(!is_null($limit), function (Builder $q) use ($limit) {
                $q->limit($limit);
            })
            ->get();
    }

    public static function getPopularsPaginate($perPage = 10)
    {
        return self::populars()->with('currency')->paginate($perPage);
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

    public function getShowRoute(): string
    {
        $routeKey = $this->getRouteKey();

        return route('store.products.show', $routeKey);
    }

    public function getPriceWithSymbol()
    {
        return $this->price . ' ' . $this->getCurrencySymbol();
    }

    public function getCurrencySymbol()
    {
        return $this->currency->symbol;
    }
}
