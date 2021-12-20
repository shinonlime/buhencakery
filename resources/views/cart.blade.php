<x-app-layout>
    <div class="container">
        <h1 class="my-4">Keranjang</h1>
        
        <?php
            $total = 0;
        ?>
        @if ( Cart::count() > 0)
        <div class="col">
            @if (session()->has('success_message'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success_message') }}
            </div>
            @endif
            <ul class="list-group mb-3">
            @foreach (Cart::content() as $item)
                <li class="list-group-item">
                    <div class="d-flex">
                        <img src="https://source.unsplash.com/500x500?cake" alt="" class="rounded  my-2 me-2" width="100" height="100">
                        <div class="col mt-2 me-2">
                            <h5>{{ $item->name }}</h5>
                            <small class="text-muted">Jumlah: {{ $item->qty }}</small><br>
                            <small class="text-muted d-none d-md-block">{{ $item->notes }}</small>
                        </div>
                        <span class="text-muted mt-2 me-2">@currency($item->price)</span>
                        <div class="col-auto d-sm-flex justify-content-between">
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-sm btn-danger bi bi-trash text-white mt-2 text-end"></button>
                            </form>
                        </div>
                    </div>
                    <small class="text-muted d-sm-block d-md-none flex">{{ $item->notes }}</small>
                </li>
            <?php
                $total += $item->price * $item->qty;
            ?>
            @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>@currency($total)</strong>
                </li>
            </ul>
    
            <div class="d-flex justify-content-between">
                <a href="{{ route('home') }}" class="btn btn-secondary">Daftar produk</a>
                <a href="{{ route('order.index') }}" class="btn btn-secondary">Berikutnya</a>
            </div>
        </div>
        
        @else
        <div class="alert alert-danger col-lg-5" role="alert">
            Tidak ada produk di keranjang
        </div>
        <div class="d-flex">
            <a href="{{ route('home') }}" class="btn btn-secondary">Daftar produk</a>
        </div>
        @endif
    </div>
</x-app-layout>