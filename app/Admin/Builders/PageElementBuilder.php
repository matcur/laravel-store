<?php

namespace App\Admin\Builders;

use App\Admin\Contracts\PageElementContract;
use App\Admin\PageElements\ProductInfo;

class PageElementBuilder
{
    private static array $elements = [
        'product-info' => ProductInfo::class
    ];

    public static function make($name): PageElementContract
    {
        if (key_exists($name, self::$elements))
            return app(self::$elements[$name]);

        throw new \Exception("$name page element doesn't exists");
    }
}
