<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models;

class ReportController extends Controller
{
    public string $base_view_folder = 'backend.report.';

    // public Product $model;

    // public function __construct()
    // {
    //     $this->model = new Product();
    // }
    public function index()
    {
        $data['records'] = OrderProduct::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->get();
        return view($this->base_view_folder . 'index', compact('data'));
    }
    public function getOrderReport(Request $request)
    {
        // Retrieve year and month from the request
        $year = $request->input('year');
        $month = $request->input('month');

        // Validate year and month
        if (!$year || !$month) {
            return response()->json(['error' => 'Year and month are required.'], 400);
        }

        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            return response()->json(['error' => 'Access denied: You do not have permission to view this url.'], 401);
        }


        // Query to get orders with order_products for the given year and month
        $productSales = OrderProduct::select('product_id', DB::raw('SUM(order_products.quantity) as total_quantity'))
            ->join('orders', 'orders.id', '=', 'order_products.order_id') // Join with the orders table
            ->where('orders.status', 2) // Filter by status == 2
            ->whereYear('order_products.created_at', $year)
            ->whereMonth('order_products.created_at', $month)
            ->groupBy('product_id')
            ->with('product.category') // Eager load product and category
            ->get();
        $response = $productSales->map(function ($orderProduct) {
            return [
                'product_id' => $orderProduct->product_id,
                'total_quantity' => $orderProduct->total_quantity,
                'product' => [
                    'id' => $orderProduct->product->id,
                    'name' => $orderProduct->product->name,
                    'price' => $orderProduct->product->price,
                    'category' => [
                        'id' => $orderProduct->product->category->id,
                        'name' => $orderProduct->product->category->name,
                    ],
                ],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }
}
