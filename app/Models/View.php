<?php

namespace App\Models;

use App\Store\Contracts\Models\Viewable;
use Carbon\Carbon;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeProducts($query)
    {
        return $query->where('viewable_type', Product::class);
    }

    public static function getProductsByColumn($column, $value)
    {
        return View::products()
            ->with('viewable')
            ->where($column, $value)
            ->get()
            ->pluck('viewable');
    }
    public static function tryCreateTodayView(Viewable $viewable, ?User $user = null, ?string $ip  = null)
    {
        if (View::todayViewExists($viewable, $user, $ip))
            View::createView($viewable, $user, $ip);
    }

    public static function createView(Viewable $viewable, ?User $user = null, ?string $ip = null)
    {
        [$userId, $ip] = View::getAuthUserViewData($user, $ip);

        return $viewable->views()->create([
            'user_id' => $userId,
            'ip' => $ip
        ]);
    }

    public static function todayViewExists(Viewable $viewable, ?User $user = null, ?string $ip = null)
    {
        [$userId, $ip] = View::getAuthUserViewData($user, $ip);

        return $viewable->views()->where([
            ['user_id', '=',  $userId],
            ['ip', '=', $ip],
            ['created_at', '>', Carbon::today()],
        ])->exists();
    }

    public static function getAuthUserViewData(User $user = null, string $ip = null)
    {
        $userId = null;
        if (is_null($user))
            $userId = auth()->id();

        if (is_null($ip))
            $ip = request()->ip();

        return [$userId, $ip];
    }
}
