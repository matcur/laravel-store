<?php

namespace App\Models;

use App\Store\Contracts\Models\HasShowRoute;
use App\Store\Contracts\Models\Viewable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements HasShowRoute, Viewable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    function getShowRoute(): string
    {
        $routeKey = $this->getRouteKey();

        return route('store.categories.show', $routeKey);
    }
}
