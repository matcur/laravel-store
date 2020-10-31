<?php


namespace App\Models\Traits;


trait HasShowRoute
{
    public function getShowATag($displayName)
    {
        $route = $this->getShowRoute();

        return "<a href='$route'>$displayName</a>";
    }

    public function getShowRoute()
    {
        $key = $this->getRouteKey();

        return route($this->showRouteName,$key);
    }
}
