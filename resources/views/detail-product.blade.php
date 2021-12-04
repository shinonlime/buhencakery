@section('title', $product->name)

<x-app-layout>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-4 mb-md-0 rounded-3 shadow" src="https://source.unsplash.com/500x500?cake" alt="..." /></div>
            <div class="col-md-6">
                {{-- <div class="small mb-1">{{ $post->name }}</div> --}}
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="fs-5 mb-4">
                    <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <p class="lead">{{ $product->description }}</p>
                <div class="d-flex">
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button class="btn btn-outline-secondary flex-shrink-0" type="submit"><i class="bi-cart-fill me-1"></i>Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>