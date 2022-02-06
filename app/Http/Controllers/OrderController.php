<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Payment;
use Midtrans;
use App\Models\User;
use Midtrans\Config;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Validated;
use Livewire\Livewire;

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



        if ($request->courierMethod > 0){
            foreach (Cart::content() as $item){
                $subtotal += $item->price * $item->qty;
            }
            $total = $subtotal + $request->courierMethod;
        } else {
            foreach (Cart::content() as $item){
                $subtotal += $item->price * $item->qty;
            }
            $total = $subtotal;
        }

        $alamat = $request->address2.'<br>No. '.$request->blokno.' '.$request->rtrw;

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'nama' => auth()->user()->name,
            'email' => auth()->user()->email,
            'no_telp' => $request->notelp,
            'alamat' => $alamat,
            'tanggal' => $request->date,
            'jam' => $request->time,
            'total' => $total
        ]);
        foreach (Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'jumlah' => $item->qty,
                'catatan' => $item->notes,
            ]);
        }

        Cart::destroy();

        return redirect()->to('/pembayaran'.'/'.$order->id);
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

    // public function show($id)
    // {
    //     if(!Auth::user()){
    //         return redirect()->route('login');
    //     }

    //     $orders = auth()->user()->orders()->with('products')->get();
        
    //     $order = Order::find($id);
        
    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = 'SB-Mid-server-EznkgWH38RPymn842AWBic34';
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => rand(),
    //             'gross_amount' => $order->total,
    //         ),

    //         'customer_details' => array(
    //             'first_name'       => "",
    //             'last_name'        => $order->name,
    //             'email'            => "test@test.com",
    //             'phone'            => $order->no_telp
    //         )
            
    //     );

    //     $this->snapToken = \Midtrans\Snap::getSnapToken($params);

    //     return view('payment', ['orders' => $orders, 'snapToken' => $this->snapToken]);
    // }

    public function show(Order $order)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-EznkgWH38RPymn842AWBic34';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order = Order::find('user_id', Auth::id())->first();

        $status = \Midtrans\Transaction::status($order->id);
        $status = json_decode(json_encode($status), true);
        $order_id = $status['order_id'];
        $gross_amount = $status['gross_amount'];
        $bank = $status['va_numbers'][0]['bank'];
        $va_number = $status['va_numbers'][0]['va_number'];
        $transaction_status = $status['transaction_status'];
        $transaction_time =  $status['transaction_time'];
        $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));

        return view('list-order', [
            'order' => $order,
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'bank' => $bank,
            'va_number' => $va_number,
            'transaction_status' => $transaction_status,
            'deadline' => $deadline
        ]);
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
