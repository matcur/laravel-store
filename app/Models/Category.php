<?php

namespace App\Models;

use App\Store\Contracts\Models\HasShowRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements HasShowRoute
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
    ];

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
