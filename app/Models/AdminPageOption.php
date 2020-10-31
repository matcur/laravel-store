<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPageOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function pages()
    {
        return $this->belongsToMany(AdminPage::class);
    }
}
