<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class Payment extends Component
{
    public $snapToken;
    public $order;
    public $order_id, $gross_amount, $bank, $va_number, $transaction_status, $deadline;

    public function mount($id)
    {
        if(!Auth::user()){
            return redirect()->route('login');
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-EznkgWH38RPymn842AWBic34';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if(isset($_GET['result_data'])){
            // $this->order = Order::find($id);

            $current_status = json_decode($_GET['result_data'], true);
            $order_id = $current_status['order_id'];
            $this->order = Order::where('id', $order_id)->first();
            $this->order->status_pembayaran = 1;
            // $this->order->transaction_id = $current_status['order_id'];
            $this->order->update();
        } else {
            $this->order = Order::find($id);
        }

        if(isset($this->order)){
            if($this->order->status_pembayaran == false){
                $params = array(
                    'transaction_details' => array(
                        'order_id'          => $this->order->id,
                        'gross_amount'      => $this->order->total,
                    ),
        
                    'customer_details' => array(
                        'first_name'       => $this->order->nama,
                        'last_name'        => "",
                        'email'            => auth()->user()->email,
                        'phone'            => $this->order->no_telp,
                        'address'          => $this->order->alamat
                    )
                );
                $this->snapToken = \Midtrans\Snap::getSnapToken($params);
            } else {
                $status = \Midtrans\Transaction::status($this->order->id);
                // $status = file_get_contents('https://api.sandbox.midtrans.com/v2/'.$this->order->id.'/status');
                $status = json_decode(json_encode($status), true);
                // dd($status);
                $this->order_id = $status['order_id'];
                $this->gross_amount = $status['gross_amount'];
                if($status['payment_type'] == 'bank_transfer')
                {
                    //BCA
                    if($status['va_numbers'][0]['bank'] == 'bca'){
                        $this->bank = $status['va_numbers'][0]['bank'];
                        $this->va_number = $status['va_numbers'][0]['va_number'];
                    }
                    //BRI
                    if($status['va_numbers'][0]['bank'] == 'bri'){
                        $this->bank = $status['va_numbers'][0]['bank'];
                        $this->va_number = $status['va_numbers'][0]['va_number'];
                    }
                    //BNI
                    if($status['va_numbers'][0]['bank'] == 'bni'){
                        $this->bank = $status['va_numbers'][0]['bank'];
                        $this->va_number = $status['permata_va_number'];
                    }
                    //PERMATA
                    $this->bank = 'permata';
                    $this->va_number = $status['va_numbers'][0]['va_number'];
                } else if($status['payment_type'] == 'echannel'){
                    //MANDIRI
                    $this->bank = 'mandiri';
                    $this->va_number = $status['bill_key'];
                }
                $this->transaction_status = $status['transaction_status'];
                $transaction_time =  $status['transaction_time'];
                $this->deadline = date('d-m-Y H:i:s', strtotime('+1 day', strtotime($transaction_time)));
            }
        }
    }

    public function render()
    {
        $orders = auth()->user()->orders()->with('products')->get();

        return view('livewire.payment')->with('orders', $orders);
    }
}
