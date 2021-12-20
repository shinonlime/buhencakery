<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function cekOngkir(Request $request)
    {
        $from = str_replace(' ', '', $request->from);
        $destination = str_replace(' ', '', $request->address);

        $result = file_get_contents('https://maps.googleapis.com/maps/api/directions/json?avoid=tolls&units=metric&origin='.$from.'&destination='.$destination.'&mode=driving&key='.env('GOOGLE_MAPS_API_KEY').'');

        $result = json_decode($result);

        // dd($result);

        $distance = $result->routes[0]->legs[0]->distance->text;
        $olddes = $request->address;

        $jarak = preg_replace('/[^0-9.]+/', '', $distance);

        $ongkir = round($jarak * 1000, -3);
        
        return view('order', ['distance' => $distance, 'olddes' => $olddes, 'ongkir' => $ongkir]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
        $subtotal = 0;

        // dd($request);

        if ($request->courierMethod >= 0){
            foreach (Cart::content() as $item){
                $subtotal += $item->price * $item->qty;
            }
            $total = $subtotal + $request->courierMethod;
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'no_telp' => $request->notelp,
            'address' => $request->address2,
            'date' => $request->date,
            'time' => $request->time,
            'total' => $total
        ]);
        foreach (Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'notes' => $item->notes,
            ]);
        }

        Cart::destroy();
    }

    public function payment(Request $request)
    {
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = auth()->user()->orders()->with('products')->get();

        return view('payment')->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
