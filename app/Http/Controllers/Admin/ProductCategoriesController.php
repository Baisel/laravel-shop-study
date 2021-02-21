<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoriesStoreRequest;
use App\Http\Requests\ProductCategoriesUpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $product_categories = ProductCategory::query();
        $product_categories->fuzzySearchable('name', $request->name);
        $search_results = $product_categories
            ->orderby(
                $request->input('sort_column', 'id'),
                $request->input('sort_direction', 'ASC')
            )->paginate(
                $request->input('page_unit', 10)
            )->appends($request->query());
        return view('admin.product_categories.index', compact('search_results'));
    }

    //商品カテゴリ新規作成画面
    public function create()
    {
        return view('admin.product_categories.create');
    }

    //商品カテゴリ新規作成処理
    public function store(ProductCategoriesStoreRequest $request)
    {
        //カテゴリを新規保存
        $product_category = ProductCategory::create($request->validated());
        return redirect()->route('admin.product_categories.show', ['product_category' => $product_category->id]);
    }

    //商品カテゴリ詳細画面
    public function show(ProductCategory $product_category)
    {
        return view('admin.product_categories.show', compact('product_category'));
    }

    //商品カテゴリ編集画面
    public function edit(ProductCategory $product_category)
    {
        return view('admin.product_categories.edit', compact('product_category'));
    }

    //商品カテゴリデータアップデート処理
    public function update(ProductCategoriesUpdateRequest $request, ProductCategory $product_category)
    {
        $product_category->update($request->validated());
        return redirect()->route('admin.product_categories.show', ['product_category' => $product_category->id]);
    }
}
