<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private Cart $model;

    public function __construct(){
        $this->model = new Cart();
    }
    public function updateCarts(Request $request)
    {
        // Retrieve cart data from the request
        $cartItems = $request->input('cart_items');
//        dd($request);
        // Iterate through the items and update the quantities
        foreach ($cartItems as $item) {
            $cartItem = $this->model->where('id', $item['id'])->first();
            if ($cartItem) {
                $cartItem->quantity = $item['quantity'];
                $cartItem->save();
            }
        }

        // Optionally, you can recalculate the total price here
//        $total = $this->model->sum('price');
//        \request()->session()->flash('success', 'Cart updated successfully!');
            echo json_encode(['success' => 'Cart updated successfully!']);
        // Redirect back to the cart page with a success contact
//        return redirect()->route('cart');
    }
    public function updateQuantity(Request $request)
    {
        $cart = Cart::find($request->cart_id);
//        dd($request);
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();

            // Calculate new total (if needed)
            $newTotal = ($cart->product->price / 100) * (100 - $cart->product->discount_percent) * $cart->quantity;

            return response()->json(['success' => true, 'new_total' => $newTotal]);
        }

        return response()->json(['success' => false]);
    }
}
