<x-app-layout>
    <div class="container">
        <h1 class="my-4">Keranjang</h1>
        @if (session()->has('success_message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success_message') }}
        </div>
        @endif
        
        @if ( Cart::count() > 0)
        @foreach (Cart::content() as $item)
        <div class="row flex-row justify-content-start d-md-none shadow-sm mt-4">
            <div class="col-auto">
                <img src="https://source.unsplash.com/500x500?cake" alt="" class="rounded mx-auto my-auto" width="100" height="100">
            </div>
            <div class="col-auto my-auto">
                <h4 class="">{{ $item->name }}</h4>
                <h5 class="">Rp{{ number_format($item->price, 0, ',', '.') }}</h5>
            </div>
            <div class="col-md-4">
                <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet reprehenderit consequatur alias, tempora commodi sapiente architecto possimus provident obcaecati cum distinctio doloribus optio facilis corporis nisi labore dolores nihil fuga?</p>
            </div>
            <div class="col-md-4 justify-content-between">
                <div class="row">
                    <div class="col">
                        <p class="text-start">Jumlah:</p>
                        <input type="number" class="form-control mb-4" style="width: 4rem" min="1" name="quantity">
                    </div>
                    <div class="col">
                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" class="text-end mb-4">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-danger bi bi-trash text-white"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="mt-4 d-flex d-md-none justify-content-between">
            <div class="d-flex justify-content-start">
                <h4 class="my-auto flex">Total:&nbsp;&nbsp;</h4>
                <h4 class="my-auto flex">Rp{{ Cart::total() }}</h4>
            </div>
            <a href="" class="my-auto d-flex btn btn-sm btn-primary justify-content-end">Checkout</a>
        </div>

        <div>
            <table class="table d-none d-md-block">
                <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <td class="col-1">
                            <img src="https://source.unsplash.com/500x500?cake" alt="" class="rounded mx-auto my-auto" width="100" height="100">
                        </td>
                        <td class="col-4" style="width: 300px">
                            <h4 class="">{{ $item->name }}</h4>
                            <h5 class="">Rp{{ number_format($item->price, 0, ',', '.') }}</h5>
                            <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet reprehenderit consequatur alias, tempora commodi sapiente architecto possimus provident obcaecati cum distinctio doloribus optio facilis corporis nisi labore dolores nihil fuga?</p>
                        </td>
                        <td class="col-1">
                            <p class="text-start text-lg-center">Jumlah:</p>
                            <input type="number" class="form-control mx-lg-auto mb-4" style="width: 4rem" min="1" name="quantity">
                        </td>
                        <td class="col-1 text-end">
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-sm btn-danger bi bi-trash text-white"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                            <h3 class="my-auto">Total</h3>
                        </td>
                        <td colspan="3">
                            <div class="d-flex justify-content-between">
                                <h4 class="my-auto d-flex justify-content-start">Rp{{ Cart::total() }}</h4>
                                <a href="" class="my-auto d-flex btn btn-sm btn-primary justify-content-end">Checkout</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        @else
        <div class="alert alert-danger" role="alert">
            Tidak ada produk di keranjang
        </div>
        @endif
        <div>
            <a href="{{ route('home') }}"></a>
        </div>
    </div>
</x-app-layout>