<?php


namespace App\DisposableUrl;


use Illuminate\Support\Str;

class DisposableUrl
{
    public static function make()
    {
        return Str::random(16);
    }

    public static function putInSession(string $sessionKeyPrefix, string $disposableUrl)
    {
        $key = self::getSessionKey($sessionKeyPrefix);

        session()->put([$key => $disposableUrl]);
    }

    public static function forgetFromSession(string $sessionKeyPrefix)
    {
        $key = self::getSessionKey($sessionKeyPrefix);

        session()->forget($key);
    }

    public static function getFromSession(string $sessionKeyPrefix)
    {
        $key = self::getSessionKey($sessionKeyPrefix);

        return session()->get($key);
    }

    public static function getSessionKey(string $sessionKeyPrefix)
    {
        return "$sessionKeyPrefix-disposable-url";
    }
}
