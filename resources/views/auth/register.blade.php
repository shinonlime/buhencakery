<x-app-layout>
    <div class="container">
        <div class="form-signin mx-auto" style="width: 18rem">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="text-center">
                    <img class="my-4" src="{{ asset('Logo Buhen.png') }}" alt="" width="200">
                    <h1 class="h3 mb-3 fw-normal">Registrasi</h1>
                </div>
          
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingInput" type="text" name="name" :value="old('name')" required autofocus placeholder="name example">
                    <label for="floatingInput">Nama</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" id="floatingInput" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPassword" type="password" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPassword" type="password" name="password_confirmation" placeholder="Konfirmasi Password">
                    <label for="floatingPassword">Konfirmasi Password</label>
                </div>
                    <button type="submit" class="btn btn-secondary text-white w-100 mb-2">Daftar</button>
                <div>
                    <a href="{{ route('login') }}" class="link-secondary text-start">Sudah memiliki akun?</a>
                </div>
                {{-- <p class="text-muted text-center my-2">Atau</p>
                <a href="{{ url('auth/google') }}" class="btn btn-secondary text-white bi bi-google w-100"> Daftar dengan Google</a> --}}
            </form>
        </div>
    </div>
</x-app-layout>
