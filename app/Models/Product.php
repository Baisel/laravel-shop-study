<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\FuzzySearchable;
use App\Models\Traits\Icon;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\WishProduct;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $product_category_id
 * @property int $price
 * @property string $name
 * @property string|null $description
 * @property string|null $icon
 * @property int $total_point
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductCategory $product_category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product fuzzySearchable($column, $keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product sortColumn($column, $order)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product sortPrice($sort, $price)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTotalPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use Icon;
    use FuzzySearchable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'product_category_id',
        'price',
        'name',
        'description',
        'icon',
        'total_point',
    ];

    /**
     * @return mixed
     */
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function wishProducts()
    {
        return $this->hasMany(WishProduct::class);
    }

    /**
     * @param Builder $query
     * @param string|null $sort
     * @param int|null $price
     * @return Builder
     */
    public function scopeSortPrice(Builder $query, ?string $sort, ?string $price)
    {
        if (filled($price)) {
            if ($sort == 'up') {
                $query->where('price', '>=', $price);
            } else {
                $query->where('price', '<=', $price);
            }
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param string $column
     * @param string $order
     * @return Builder
     */
    public function scopeSortColumn(Builder $query, string $column, string $order)
    {
        if ($column == 'product_categories.order_no') {
            $query->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                ->select('products.*');
        }
        return $query->orderby($column, $order);
    }
}
