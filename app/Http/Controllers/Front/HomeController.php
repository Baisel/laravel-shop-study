<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\WishProduct;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $wish_products = null;
        if (auth()->user()) {
            $wish_products = WishProduct::where('user_id', '=', auth()->user()->id)
                ->with(['product'])
                ->get();
        }
        return view('front.home',compact('wish_products'));
    }
}
