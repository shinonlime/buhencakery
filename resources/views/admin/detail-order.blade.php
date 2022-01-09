@extends('admin.admin-layout')

@section('section')
<div class="container">
    <h1 class="my-4">Detail order</h1>
    <div class="col">
        <ul class="list-group mb-3">
            <?php 
                $status = \Midtrans\Transaction::status($order->id);
                // $status = file_get_contents('https://api.sandbox.midtrans.com/v2/'.$order->id.'/status');
                $status = json_decode(json_encode($status), true);
                // dd($status);
                $order_id = $status['order_id'];
                $gross_amount = $status['gross_amount'];
                if($status['payment_type'] == 'bank_transfer')
                {
                    //BCA
                    if($status['va_numbers'][0]['bank'] == 'bca'){
                        $bank = $status['va_numbers'][0]['bank'];
                        $va_number = $status['va_numbers'][0]['va_number'];
                    }
                    //BRI
                    if($status['va_numbers'][0]['bank'] == 'bri'){
                        $bank = $status['va_numbers'][0]['bank'];
                        $va_number = $status['va_numbers'][0]['va_number'];
                    }
                    //BNI
                    if($status['va_numbers'][0]['bank'] == 'bni'){
                        $bank = $status['va_numbers'][0]['bank'];
                        $va_number = $status['permata_va_number'];
                    }
                    //PERMATA
                    $bank = 'permata';
                    $va_number = $status['va_numbers'][0]['va_number'];
                } else if($status['payment_type'] == 'echannel'){
                    //MANDIRI
                    $bank = 'mandiri';
                    $va_number = $status['bill_key'];
                }
                $transaction_status = $status['transaction_status'];
                $transaction_time =  $status['transaction_time'];
                $deadline = date('d-m-Y H:i:s', strtotime('+1 day', strtotime($transaction_time)));

                $date = date('d-m-Y', strtotime($order->tanggal));
            ?>
            @foreach ($order->products as $item)
            <li class="list-group-item">
                <div class="d-flex">
                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="" class="rounded  my-2 me-2" width="100" height="100">
                    <div class="col mt-2 me-2">
                        <h5>{{ $item->nama }}</h5>
                        <small class="text-muted">Jumlah: {{ $item->pivot->jumlah }}</small><br>
                        <small class="text-muted d-none d-md-block">{{ $item->pivot->catatan }}</small>
                    </div>
                    <div>
                        @if ($order->status == false)
                            @if ($transaction_status == 'pending')
                                <span class="badge bg-primary">Perlu dibayar</span>
                            @elseif ($transaction_status == 'settlement')
                                <span class="badge bg-success">Pembayaran berhasil</span>
                            @elseif ($transaction_status == 'failure')
                                <span class="badge bg-danger">Pembayaran gagal</span>
                            @endif
                        @else
                            <span class="badge bg-danger">Pesanan dibatalkan</span>
                        @endif
                    </div>
                    
                </div>
                <small class="text-muted d-sm-block d-md-none flex">{{ $item->pivot->catatan }}</small>
            </li>
            @endforeach
            <li class="list-group-item">
                <div class="d-flex justify-content-between my-2">
                    <div>
                        <h5>Total: @currency($order->total)</h5>
                    </div>
                </div>
                <div class="" id="detail-transaksi-{{ $order->id }}">
                    <ul class="list-group w-100">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                            Tanggal
                            <span class="ms-4">{{ $date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                            Jam
                            <span class="ms-4">{{ $order->jam }}</span>
                        </li>
                        @isset($order->address)
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                            Alamat
                            <span class="text-end text-wrap ms-4">{{ $order->alamat }}</span>
                        </li>
                        @endisset
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection