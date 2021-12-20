<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand text-indigo" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link text-white" aria-current="page" href="/">Beranda</a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link" aria-current="page" href="{{ route('product.index') }}">Produk</a> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" aria-current="page" href="#">Koleksi</a>
            </li>
        </ul>
        @auth
        <div>

        </div>
        <div class="d-flex">
            <div class="my-auto">
                <a href="{{ route('cart.index') }}" class="text-decoration-none text-white bi bi-cart3"> ({{ Cart::count() }})</a>
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}&nbsp;</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li><a class="dropdown-item" href="route('logout')"onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                    </form>
                </ul>
            </div>
        </div>
        @else
        <a href="{{ route('login') }}" class="btn text-white shadow-none">Masuk</a>

        {{-- Register --}}
        <a href="{{ route('register') }}" class="ms-2 btn btn-secondary text-white">Daftar</a>

        {{-- <a href="{{ route('login') }}" class=" ms-2 btn btn-outline-primary">Login</a>
        <a href="{{ route('register') }}" class="ms-2 btn btn-outline-primary">Register</a> --}}
        {{-- <div class="d-flex btn-group" role="group">
        </div> --}}

        @endauth
        </div>
    </div>
</nav>