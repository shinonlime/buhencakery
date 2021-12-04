<x-app-layout>
    <div class="container col-xl-10 col-xxl-8 px-4 py-4">
        <div class="row align-items-center flex-row-reverse g-lg-5">
            <div class="col-lg-7 text-center text-lg-start">
                <img src="https://getbootstrap.com/docs/5.0/examples/heroes/bootstrap-themes.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-md-10 mx-auto col-lg-5 py-4 text-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Vertically centered hero</h1>
                <p class="col-lg-10 fs-4 text-start text-wrap">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-left mb-4">Produk</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-2">
            @foreach ($products as $product)
                <div class="col mb-4 d-flex justify-content-center">
                    <a href="/produk/{{ $product->slug }}" class="text-decoration-none text-black">
                        <div class="card shadow h-100" style="width: 18rem">
                            <img src="https://source.unsplash.com/600x350?cake" class="card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <h6 class="card-title">Rp{{ number_format($product->price, 0, ',', '.') }}</h6>
                                <p class="card-text">{{ $product->description }}</p>
                            </div>
                            {{-- <div class="card-footer">
                                <a href="/produk/{{ $product->slug }}" class="btn btn-outline-secondary">Detail produk</a>
                            </div> --}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
