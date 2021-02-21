<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class ProductReview extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'product_id',
        'rank',
    ];

    /**
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     * @param int $product_id
     * @return Builder
     */
    public function scopeReviewInit(Builder $query, int $product_id)
    {
        $query->orderBy('created_at', 'desc')
            ->with(['user'])
            ->where('product_id', '=', $product_id)
            ->get();
        return $query;
    }
}
