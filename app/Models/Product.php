<?php

namespace App\Models;

use App\Store\Contracts\Models\HasShowRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model implements HasShowRoute
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'currency_id',
        'price',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
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
}
