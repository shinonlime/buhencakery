@section('title', ' | '.$product->name)

<x-app-layout>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-4 mb-md-0 rounded-3 shadow" src="https://source.unsplash.com/500x500?cake" alt="..." /></div>
            <div class="col-md-6">
                {{-- <div class="small mb-1">{{ $post->name }}</div> --}}
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="fs-5 mb-4">
                    <span>Rp{{ number_format($product->price, 0, '', '.') }}</span>
                </div>
                <p class="lead">{{ $product->description }}</p>
                <div class="">
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <div>
                            <label class="text-start" for="qty">Jumlah:</label>
                            <input type="number" class="form-control mb-2" style="width: 4rem" min="1" name="qty" id="qty" value="1">
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Catatan" id="floatingTextarea2" style="height: 100px" name="notes"></textarea>
                            <label for="floatingTextarea2">Catatan</label>
                        </div>
                        <button class="btn btn-outline-secondary flex-shrink-0" type="submit"><i class="bi-cart-fill me-1"></i>Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>