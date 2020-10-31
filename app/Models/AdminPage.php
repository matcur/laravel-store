<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route_name',
        'parent_page_id',
    ];

    public function pageOptions()
    {
        return $this->belongsToMany(AdminPageOption::class, );
    }
}
