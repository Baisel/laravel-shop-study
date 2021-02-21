<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsStoreRequest;
use App\Http\Requests\ProductsUpdateRequest;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::get();
        $query = Product::query();
        if (filled($request->product_category_id)) {
            $query->where('product_category_id', '=', $request->input('product_category_id'));
        }
        $query->sortPrice($request->price_compare, $request->input('price'));
        $query->fuzzySearchable('products.name', $request->name);
        $search_results = $query
            ->sortColumn($request->input('sort_column', 'id'),
                $request->input('sort_direction', 'ASC'))
            ->paginate($request->input('page_unit', 10)
            )->appends($request->query());
        return view('admin.products.index', compact('search_results', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductsStoreRequest $request)
    {
        $product = Product::create($request->validated());
        return redirect()->route('admin.products.show', ['product' => $product->id]);
    }

    public function show(Product $product)
    {
        $category = ProductCategory::find($product->category_id);
        return view('admin.products.show', compact('product', 'category'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductsUpdateRequest $request, Product $product)
    {
        if ($request->delete_icon == 1) {
            $product->icon = null;
        }
        $product->update($request->validated());
        return redirect()->route('admin.products.show', ['product' => $product->id]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
