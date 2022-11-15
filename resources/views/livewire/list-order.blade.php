<div class="container">
    <h1 class="my-4">Daftar Pesanan</h1>
        @if ( $order->count() > 0)
        <div class="col">
            @foreach ($order as $orders)
            <ul class="list-group mb-3">
                <?php 
                    $status = \Midtrans\Transaction::status($orders->id);
                    // $status = file_get_contents('https://api.sandbox.midtrans.com/v2/'.$order->id.'/status');
                    $status = json_decode(json_encode($status), true);
                    // dd($status);
                    $order_id = $status['order_id'];
                    $gross_amount = $status['gross_amount'];
                    if($status['payment_type'] == 'bank_transfer')
                    {
                        if ($status['va_numbers']) {
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
                        } else {
                            $bank = 'permata';
                            $va_number = $status['va_numbers'][0]['va_number'];
                        }
                    } else if($status['payment_type'] == 'echannel'){
                        //MANDIRI
                        $bank = 'mandiri';
                        $va_number = $status['bill_key'];
                    }
                    $transaction_status = $status['transaction_status'];
                    $transaction_time =  $status['transaction_time'];
                    $deadline = date('d-m-Y H:i:s', strtotime('+1 day', strtotime($transaction_time)));

                    $date = date('d-m-Y', strtotime($orders->tanggal));
                ?>
                @foreach ($orders->products as $item)
                <li class="list-group-item">
                    <div class="d-flex">
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="" class="rounded  my-2 me-2" width="100" height="100">
                        <div class="col mt-2 me-2">
                            <h5>{{ $item->nama }}</h5>
                            <small class="text-muted">Jumlah: {{ $item->pivot->jumlah }}</small><br>
                            <small class="text-muted d-none d-md-block">{{ $item->pivot->catatan }}</small>
                        </div>
                        <div>
                            @if ($orders->status == false)
                                @if ($transaction_status == 'pending')
                                    <span class="badge bg-primary">Perlu dibayar</span>
                                @elseif ($transaction_status == 'settlement')
                                    <span class="badge bg-success">Pembayaran berhasil</span>
                                @elseif ($transaction_status == 'expire')
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
                            <h5>Total: @currency($orders->total)</h5>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#detail-transaksi-{{ $orders->id }}" aria-expanded="false" aria-controls="detail-transaksi-{{ $orders->id }}">Detail order</button>
                    </div>
                    <div class="collapse" id="detail-transaksi-{{ $orders->id }}">
                        <ul class="list-group w-100">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Tanggal
                                <span class="ms-4">{{ $date }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Jam
                                <span class="ms-4">{{ $orders->jam }}</span>
                            </li>
                            @isset($orders->address)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Alamat
                                <span class="text-end text-wrap ms-4">{{ $orders->alamat }}</span>
                            </li>
                            @endisset
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <div>
                                    VA <span class="text-uppercase">{{ $bank }}</span>
                                </div>
                                <span class="ms-4">{{ $va_number }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Deadline
                                <span class="ms-4 text-wrap">{{ $deadline }}</span>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            @endforeach
        </div>
        
        @else
        <div class="alert alert-danger col-lg-5" role="alert">
            Tidak ada produk yang diorder
        </div>
        <div class="d-flex">
            <a href="{{ route('home') }}" class="btn btn-secondary">Daftar produk</a>
        </div>
        @endif
</div>
