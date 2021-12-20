<x-app-layout>
    <div class="container">
        <div class="form-signin mx-auto" style="width: 18rem">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center">
                    <img class="my-4" src="https://icons.getbootstrap.com/assets/img/icons-hero.png" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Masuk</h1>
                </div>
            
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" type="email" name="email" :value="old('email')">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" type="password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
            
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Ingat saya
                    </label>
                </div>

                <a href="{{ route('login') }}" class="link-secondary">Lupa password?</a>
                <button class="w-100 btn btn-secondary mt-4" type="submit">Masuk</button>
                <p class="text-muted text-center my-2">Atau</p>
                <a href="{{ url('auth/google') }}" class="btn btn-secondary text-white bi bi-google w-100"> Masuk dengan Google</a>
            </form>
        </div>
    </div>
</x-app-layout>
