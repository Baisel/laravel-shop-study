<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviewsStoreRequest;
use App\Http\Requests\ProductReviewsUpdateRequest;
use App\Models\Product;
use App\Models\ProductReview;

class ProductReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Product $product)
    {
        return view('front.reviews.create', compact( 'product'));
    }

    public function store(Product $product, ProductReviewsStoreRequest $request)
    {
        ProductReview::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'rank' => $request->rank,
        ]);
        return redirect()->route('front.products.show', ['product' => $product->id]);
    }

    public function edit(Product $product, ProductReview $product_review)
    {
        $this->authorize('update', $product_review);
        return view('front.reviews.edit', compact( 'product', 'product_review'));
    }

    public function update(Product $product, ProductReview $product_review, ProductReviewsUpdateRequest $request)
    {
        $this->authorize('update', $product_review);
        $product_review->update($request->validated());
        return redirect()->route('front.products.show', ['product' => $product->id]);
    }

}
