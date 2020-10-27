<?php


namespace App\Store\Recommends;


use App\Models\Product;
use App\Models\User;
use App\Models\View;
use App\Paginators\CollectionPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RecommendProduct
{
    /**
     * @param string|User $value
     * @param null|int $count
     * @return Collection
     */
    public static function get($value, int $count = null)
    {
        $categoriesIds = self::getRecommendCategoriesIds($value);

        $query = Product::whereIn('category_id', $categoriesIds)
            ->with('currency')
            ->inRandomOrder();

        if (is_null($count))
            return $query->get();

        return $query
            ->limit($count)
            ->get();
    }

    /**
     * @param string|User $value
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public static function getPaginate($value, $perPage = 10)
    {
        $products = self::get($value);

        return CollectionPaginator::paginate($products, $perPage);
    }

    /**
     * Возвращает категории рекоммендованных продуктов,
     * основываясь на id или ip пользователя.
     *
     * @param string|User $value
     * @return Collection
     */
    private static function getRecommendCategoriesIds($value)
    {
        /** @var Collection $viewedProducts */
        if ($value instanceof User) {
            $viewedProducts = View::getProductsByColumn('user_id', $value->id);

            return $viewedProducts->unique('category_id')->pluck('category_id');
        } elseif (preg_match(IP_PREG_MATCH, $value)) {
            $viewedProducts = View::getProductsByColumn('ip', $value);

            return $viewedProducts->unique('category_id')->pluck('category_id');
        }

        throw new \InvalidArgumentException("[$value] must be instance of " . User::class . " or ip");
    }
}
