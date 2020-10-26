<?php


namespace App\Store\Services;


use App\Models\User;
use App\Models\View;
use App\Store\Contracts\Models\Viewable;
use Carbon\Carbon;

class ViewService
{
    public function getProductsByColumn($column, $value)
    {
        return View::products()
            ->with('viewable')
            ->where($column, $value)
            ->get()
            ->pluck('viewable');
    }

    public function tryCreateTodayView(Viewable $viewable, ?User $user = null, ?string $ip  = null)
    {
        if (!$this->todayViewExists($viewable, $user, $ip))
            $this->createView($viewable, $user, $ip);
    }

    public function createView(Viewable $viewable, ?User $user = null, ?string $ip = null)
    {
        [$userId, $ip] = $this->getAuthUserViewData($user, $ip);

        return $viewable->views()->create([
            'user_id' => $userId,
            'ip' => $ip
        ]);
    }

    public function todayViewExists(Viewable $viewable, ?User $user = null, ?string $ip = null)
    {
        [$userId, $ip] = $this->getAuthUserViewData($user, $ip);

        return $viewable->views()->where([
            ['user_id', '=',  $userId],
            ['ip', '=', $ip],
            ['created_at', '>', Carbon::today()],
        ])->exists();
    }

    public function getAuthUserViewData(User $user = null, string $ip = null)
    {
        $userId = null;
        if (is_null($user))
            $userId = auth()->id();

        if (is_null($ip))
            $ip = request()->ip();

        return [$userId, $ip];
    }
}
