<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.dashboard', compact('orders', $orders));
    }

    public function showProduct()
    {
        $products = Product::get();

        return view('admin.list-product')->with('products', $products);
    }

    public function cancel($id) 
    {
        $status = Order::find($id);

        $status->status = true;

        $status->save();

        return redirect('/admin/dashboard')->with('success', 'Berhasil dibatalkan!');
    }
    
    public function show($id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-EznkgWH38RPymn842AWBic34';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order = Order::where('id', $id)->firstOrFail();

        return view ('admin.detail-order')->with('order', $order);
    }
}
