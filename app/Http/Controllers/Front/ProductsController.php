<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\WishProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $selected_category = null;
        $query = Product::query();
        //ソートが選択されてる場合はソートし、なければトータルポイント順でのソート
        if (empty($request->sort) || $request->sort == "review_rank-desc") {
            //トータルポイントをproductのtottal_pointに格納
            $total_points = DB::table('product_reviews')
                ->select(DB::raw('product_id,sum(rank) as point'))
                ->groupBy('product_id')
                ->get();
            foreach ($total_points as $total_point) {
                Product::find($total_point->product_id)
                    ->update(['total_point' => $total_point->point]);
            }
            $query->orderby('total_point', 'DESC');
        } elseif ($request->sort == "price-asc") {
            $query->orderby('price', 'ASC');
        } elseif ($request->sort == "price-desc") {
            $query->orderby('price', 'DESC');
        } elseif ($request->sort == "updated_at-desc") {
            $query->orderby('updated_at', 'DESC');
        }
        //ジャンルとキーワードがどちらも選択された場合
        if ($request->input('category_id') && $request->input('keyword')) {
            $query->where('product_category_id', '=', $request->input('category_id')
            )->where('name', 'like', '%' . $request->input('keyword') . '%');
            $query->orwhere('product_category_id', '=', $request->input('category_id'))
                ->where('description', 'like', '%' . $request->input('keyword') . '%');
            $selected_category = ProductCategory::find($request->input('category_id'));
            //ジャンルのみ選択された場合
        } elseif ($request->input('category_id')) {
            $query->where('product_category_id', '=', $request->input('category_id'));
            $selected_category = ProductCategory::find($request->input('category_id'));
            //キーワードのみ指定された場合
        } elseif ($request->input('keyword')) {
            $query->where('name', 'like', '%' . $request->input('keyword') . '%')
                ->orwhere('description', 'like', '%' . $request->input('keyword') . '%');
        }
        //ログインしていればポイントを集計
        if (auth()->user()) {
            $query->with(['wishProducts' => function ($query) {
                $query->where('user_id', '=', auth()->user()->id);
            }]);
        }
        $products = $query->paginate(15)->appends($request->query());
        return view('front.products.index', compact('products', 'selected_category'));
    }

    public function show(Product $product)
    {
        $my_reviews = null;
        $wish_product = null;
        $my_query = ProductReview::query()->reviewInit($product->id);
        $other_query = ProductReview::query()->reviewInit($product->id);
        if (auth()->user()) {
            $wish_product = WishProduct::where('product_id', '=', $product->id)
                ->where('user_id', '=', auth()->user()->id)
                ->first();
            $my_reviews = $my_query
                ->where('user_id', '=', auth()->user()->id)
                ->get();
            $other_reviews = $other_query
                ->where('user_id', '!=', auth()->user()->id);
        }
        $other_reviews = $other_query->get();
        return view('front.products.show', compact('product', 'other_reviews', 'my_reviews', 'wish_product'));
    }

    public function wish_product(Request $request)
    {
        if ($request->input('wish_product') == 0) {
            WishProduct::create([
                'product_id' => $request->input('product_id'),
                'user_id' => auth()->user()->id,
            ]);
        } elseif ($request->input('wish_product') == 1) {
            WishProduct::where('product_id', "=", $request->input('product_id'))
                ->where('user_id', "=", auth()->user()->id)
                ->delete();
        }
        return $request->input('wish_product');
    }
}
