<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListOrder extends Component
{
    public $order;
    public $date;
    public $order_id, $gross_amount, $bank, $va_number, $transaction_status, $deadline;

    public function mount()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-EznkgWH38RPymn842AWBic34';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $this->order = auth()->user()->orders()->with('products')->first();

        // dd($this->order);
    }

    public function render()
    {
        $this->order = auth()->user()->orders()->with('products')->get();
        
        if(!Auth::user()){
            return redirect()->route('login');
        } else {
            return view('livewire.list-order');
        }
        
        
    }
}
