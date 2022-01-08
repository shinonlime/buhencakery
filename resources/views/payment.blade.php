<x-app-layout>
    <div class="container">
        <h1 class="my-4">Detail Order</h1>
        @foreach ($orders as $order)
        <div class="d-flex justify-content-center">
            <ul class="list-group w-100 w-lg-75 shadow">
                <h6 class="">List Produk:</h6>
                <div class="accordion mb-2" id="accordionFlushExample">
                    @foreach ($order->products as $product)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">{{ $product->name }}
                                    <div class="d-flex justify-content-between"></div>
                                </button>
                            </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Jumlah: {{ $product->pivot->jumlah }}<br>
                                {{ $product->pivot->catatan }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">Nama</div>
                    <div>{{ $order->nama }}</div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">No. Telp</div>
                    <div>{{ $order->no_telp }}</div>
                </li>
                @isset($order->address)
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">Alamat</div>
                    <div>{{ $order->alamat }}</div>
                </li>
                @endisset
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">Total</div>
                    <div class="fw-bold">@currency($order->total)</div>
                </li>
            </ul>
        </div>
        @endforeach
        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-secondary" id="pay-button">Bayar</button>
        </div>
        <form action="{{ route('order.status') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" id="result-json" name="result_data">
        </form>
    </div>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-XFYlpES0UrhChycM"></script>
    <script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step

        // var resultType = document.getElementById('result-type');
        // var resultData = document.getElementById('result-data');
        // function changeResult(type, data){
        //     $('#result-type').val(type);
        //     $('#result-data').JSON.stringify(data);
        //     //resultType.innerHTML = type;
        //     //resultData.innerHTML = JSON.stringify(data);
        // }
        snap.pay('<?=$snapToken?>', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ 
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            document.getElementById('payment-form').submit();   

            // changeResult('success', result);
            // $('#payment-form').submit();
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ 
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            document.getElementById('payment-form').submit();   

            // changeResult('pending', result);
            // $('#payment-form').submit();
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ 
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            document.getElementById('payment-form').submit();   

            // changeResult('error', result);
            // $('#payment-form').submit();
          }
        });
      };
    </script>
</x-app-layout>