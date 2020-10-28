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
     * @throws \Exception
     */
    private static function getRecommendCategoriesIds($value)
    {
        if ($value instanceof User) {
            $columnName = 'user_id';
            $value = $value->id;
        } elseif (preg_match(IP_PREG_MATCH, $value)) {
            $columnName = 'ip';
        } else {
            throw new \Exception("[$value] must be instance of " . User::class . " or ip");
        }

        /** @var Collection $viewedProducts */
        $viewedProducts = View::getProductsByColumn($columnName, $value);

        return $viewedProducts->unique('category_id')->pluck('category_id');
    }
}
