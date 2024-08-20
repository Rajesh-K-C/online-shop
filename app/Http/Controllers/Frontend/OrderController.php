<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        if(Auth::user()->address_id == null || Auth::user()->phone){
            \request()->session()->flash('error','Before continuing, fill in your address and phone number.');
            return redirect()->back();
        }
        // Retrieve the user's cart items
        $cartItems = Cart::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate the total order amount
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += ($cartItem->product->price / 100) * (100 - $cartItem->product->discount_percent) * $cartItem->quantity;
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 1,
            ]);

            // Copy cart items to order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product->id,
                    'quantity' => $cartItem->quantity,
                    'discount_percent' => $cartItem->product->discount_percent,
                    'price' => ($cartItem->product->price / 100) * (100 - $cartItem->product->discount_percent),
                ]);
            }

            // Clear the cart
            Cart::where('user_id', auth()->id())->delete();

            // Commit transaction
            DB::commit();

            return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to place the order.');
        }
    }
}
