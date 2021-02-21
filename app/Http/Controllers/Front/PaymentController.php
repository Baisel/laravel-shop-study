<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;


class PaymentController extends Controller
{
    public function charge(Product $product,Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::create([
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ]);
            Charge::create([
                'customer' => $customer->id,
                'amount' => $product->price,
                'description' => $product->name,
                'currency' => 'jpy'
            ]);

            return back();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
