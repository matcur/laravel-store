<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewable_type',
        'viewable_id',
        'user_id',
        'ip',
    ];

    public function viewable()
    {
        return $this->morphTo();
    }

    public function scopeProducts($query)
    {
        return $query->where('viewable_type', Product::class);
    }
}
