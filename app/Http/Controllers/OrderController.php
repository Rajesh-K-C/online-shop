<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public string $model_name = 'Order';
    public string $base_view_folder = 'backend.order.';
    public string $base_image_folder = 'assets/images/order';

    public Order $model;

    public function __construct()
    {
        $this->model = new Order();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records'] = $this->model->all();
        return view("{$this->base_view_folder}index", compact('data'));
    }

    public function edit(string $id)
    {

        $order = Order::find($id);
        if ($order == null) {
            \request()->session()->flash('error', 'Order Not Found');
            return redirect(route('backend.order.index'));
        }
        return view('backend.order.edit', compact('order'));
    }
    public function payment_failed(Request $request)
    {
        $data = $request->input('data');
        $s = json_decode(base64_decode($data));
        $id = substr($s->transaction_uuid,2);
        if (!$id) {
            return redirect()->route('cart', $id)->with('error', 'Payment failed!');
        }

        OrderProduct::where('order_id', $id)->delete();
        Order::find($id)->delete();
        dd();
        return view('frontend.payment_failed');
    }
    public function payment_success(Request $request)
    {
        $data = $request->input('data');
        $s = json_decode(base64_decode($data));
        $id = substr($s->transaction_uuid,2);
        if (!$id) {
            return redirect()->route('cart', $id)->with('error', 'Payment failed!');
        }

        $orderProducts = OrderProduct::where('order_id', $id)->get();
        foreach ($orderProducts as $product) {
            // dd($product);
            $p = Product::find($product->product_id);
            // dd($p);
            $p->update(['stock' => $p->stock - $product->quantity]);
        }
        Order::find($id)->update(['status' => 1]);
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->route('order.show', $id)->with('success', 'Order placed successfully!');
    }

    public function show(string $id)
    {
        $data['order'] = $this->model->find($id);
        // $data['order']->update(["status" => 2]);
        // dd($data['order']);
        if ($data['order'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route('dashboard'));
        }
        return view("frontend.order", compact('data'));
    }
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            \request()->session()->flash('error', 'Order Not Found');
            return redirect(route('backend.order.index'));
        }

        // dd($request->all(), $id);

        $request->request->add(['updated_by' => auth()->user()->id]);

        if ($order->update($request->all())) {
            $request->session()->flash('success', $this->model_name . ' Updated Successfully');
            return redirect(route('backend.order.index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
            return redirect(route('backend.order.edit'));
        }
    }
    public function destroy(string $id)
    {

        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route('backend.order.index'));
        } else {
            $orderItems = OrderProduct::where('order_id', $id)->get();
            foreach ($orderItems as $item) {
                $item->delete();
            }
            if ($data['record']->delete()) {
                \request()->session()->flash('success', $this->model_name . ' Deleted Successfully');
            } else {
                request()->session()->flash('error', $this->model_name . ' Deletion Failed');
            }
            return redirect()->route('backend.order.index');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->address_id == null || Auth::user()->phone == null) {
            \request()->session()->flash('error', 'Before continuing, fill in your address and phone number.');
            return redirect()->back();
        }
        // Retrieve the user's cart items
        $cartItems = Cart::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }
        // Calculate the total order amount
        $sub_total = 0;
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $sub_total += $cartItem->product->price * $cartItem->quantity;
            $total += ($cartItem->product->price / 100) * (100 - $cartItem->product->discount_percent ?: 0) * $cartItem->quantity;
        }
        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'sub_total' => $sub_total,
                'total_discount' => $sub_total - $total,
                'grand_total' => $total,
                'status' => 0,
                'phone_number' => auth()->user()->phone,
                'shipping_address' => auth()->user()->address->address,
            ]);

            // Copy cart items to order items
            foreach ($cartItems as $cartItem) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product->id,
                    'quantity' => $cartItem->quantity,
                    'discount_percent' => $cartItem->product->discount_percent ?: 0,
                    'discount_amount' => 0,
                    'price' => ($cartItem->product->price / 100) * (100 - $cartItem->product->discount_percent),
                ]);
            }

            // Clear the cart
            // Cart::where('user_id', auth()->id())->delete();

            // Commit transaction
            DB::commit();
            $msg = "total_amount=$order->grand_total,transaction_uuid=MP$order->id,product_code=EPAYTEST";
            $s = hash_hmac('sha256', $msg, '8gBm/:&EnhH.1/q', true);
            $hash = base64_encode($s);
            $orderData = ["id" => $order->id, 'amount' => $order->grand_total, 'hash' => $hash];
            return view('frontend.payment', compact('orderData'));
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to place the order.');
        }
    }
}
