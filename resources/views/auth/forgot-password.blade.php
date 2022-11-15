<x-app-layout>
    <div class="container">
        <div class="form-signin mx-auto" style="width: 18rem">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="text-center">
                    <img class="my-4" src="{{ asset('Logo Buhen.png') }}" alt="" width="200">
                    <h1 class="h3 mb-3 fw-normal">Lupa password</h1>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" type="email" name="email" :value="old('email')">
                    <label for="floatingInput">Email</label>
                </div>
                <button class="w-100 btn btn-secondary mt-4" type="submit">Submit</button>
                {{-- <p class="text-muted text-center my-2">Atau</p> --}}
                {{-- <a href="{{ url('auth/google') }}" class="btn btn-secondary text-white bi bi-google w-100"> Masuk dengan Google</a> --}}
            </form>
        </div>
    </div>
</x-app-layout>
