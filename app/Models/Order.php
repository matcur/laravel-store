<?php

namespace App\Models;

use App\Store\Cart\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_json',
        'is_paid',
        'paid_at',
    ];

    public static function createFromCart(Cart $cart)
    {
        return Order::create([
            'products_json' => $cart->content,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
