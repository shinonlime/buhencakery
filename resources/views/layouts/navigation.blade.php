<nav class="navbar navbar-expand-md navbar-dark bg-indigo-700">
    <div class="container">
        <a class="navbar-brand text-indigo" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Koleksi</a>
            </li>
        </ul>
        @auth
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
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
        @else

        {{-- Login --}}
        <button type="button" class="btn text-white shadow-none" data-bs-toggle="modal" data-bs-target="#Login">Masuk</button>
        <div class="modal fade" id="Login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-content position-absolute top-50 start-50 translate-middle" style="width: 350px">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Masuk</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" type="password" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    </div>
                    <button type="submit" class="btn btn-secondary text-white w-100 mb-2">Masuk</button>
                    <div>
                    <a href="" class="link-secondary" data-bs-target="#FPassword" data-bs-toggle="modal">Lupa password?</a>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('auth/google') }}" class="btn btn-secondary text-white bi bi-google w-100 my-2"> Masuk dengan Google</a>
                </div>
                </div>
            </form>
            </div>
        </div>

        {{-- Lupa Password --}}
        <div class="modal fade" id="FPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="modal-content position-absolute top-50 start-50 translate-middle" style="width: 350px">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Masuk</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                    </div>
                    <button type="submit" class="btn btn-secondary text-white w-100 mb-2">Submit</button>
                </div>
                </div>
            </form>
            </div>
        </div>

        {{-- Register --}}
        <button type="button" class="ms-2 btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#Register">Daftar</button>
        <div class="modal fade" id="Register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="modal-content position-absolute top-50 start-50 translate-middle" style="width: 350px">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Masuk</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" type="text" name="name" :value="old('email')" required autofocus placeholder="name example">
                    <label for="floatingInput">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" type="password" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" type="password" name="password_confirmation" placeholder="Konfirmasi Password">
                    <label for="floatingPassword">Konfirmasi Password</label>
                    </div>
                    <button type="submit" class="btn btn-secondary text-white w-100 mb-2">Registrasi</button>
                    <div>
                    <a href="#" class="link-secondary" data-bs-target="#Login" data-bs-toggle="modal">Sudah memiliki akun?</a>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('auth/google') }}" class="btn btn-secondary text-white bi bi-google w-100 my-2"> Masuk dengan Google</a>
                </div>
                </div>
            </form>
            </div>
        </div>

        {{-- <a href="{{ route('login') }}" class=" ms-2 btn btn-outline-primary">Login</a>
        <a href="{{ route('register') }}" class="ms-2 btn btn-outline-primary">Register</a> --}}
        {{-- <div class="d-flex btn-group" role="group">
        </div> --}}

        @endauth
        </div>
    </div>
</nav>