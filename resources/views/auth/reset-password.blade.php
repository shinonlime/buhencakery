<x-app-layout>
    <div class="container">
        <div class="form-signin mx-auto" style="width: 18rem">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <div class="text-center">
                    <img class="my-4" src="{{ asset('Logo Buhen.png') }}" alt="" width="200">
                    <h1 class="h3 mb-3 fw-normal">Login</h1>
                </div>
                
                {{-- <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <p>Email: {{ $request->email }}</p>
                <input type="hidden" name="email" value="{{ $request->email }}">
                
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPasswordConfirmation" placeholder="Password" name="password_confirmation" required>
                    <label for="floatingPasswordConfirmation">Konfirmasi Password</label>
                </div>
            
                <button class="w-100 btn btn-secondary mt-4" type="submit">Reset Password</button>
                {{-- <p class="text-muted text-center my-2">Atau</p> --}}
                {{-- <a href="{{ url('auth/google') }}" class="btn btn-secondary text-white bi bi-google w-100"> Masuk dengan Google</a> --}}
            </form>
        </div>
    </div>
</x-app-layout>
