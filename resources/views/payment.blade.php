<x-app-layout>
    <div class="container">
        <h1 class="my-4">Detail Order</h1>
        @foreach ($orders as $order)
        <div class="d-flex justify-content-center">
            <ul class="list-group w-100 w-lg-75 shadow">
                <h6 class="ms-1">List Produk:</h6>
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
                                Jumlah: {{ $product->pivot->quantity }}<br>
                                {{ $product->pivot->notes }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">Nama</div>
                    <div>{{ $order->name }}</div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">No. Telp</div>
                    <div>{{ $order->no_telp }}</div>
                </li>
                @isset($order->address)
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-muted">Alamat</div>
                    <div>{{ $order->address }}</div>
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
            <button class="btn btn-secondary">Bayar</button>
        </div>
    </div>
</x-app-layout>