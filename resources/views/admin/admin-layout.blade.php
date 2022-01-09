<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Buhen Cakery @yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireStyles
        <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
          }
    
          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
        </style>
    
        
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
      </head>
      <body>
    
    <header class="navbar navbar-light sticky-top bg-white flex-md-nowrap p-0 shadow">
      <a class="col-md-3 col-lg-2 me-0 m-2" href=""><img src="{{ asset('Logo Buhen.png') }}" alt="" width="100"></a>
      <button class="navbar-toggler position-absolute d-md-none collapsed my-auto" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="" aria-label="" disabled readonly> --}}
    </header>
    
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
          <div class="pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('admin.index') }}">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="nav-link px-3" href="route('logout')"onclick="event.preventDefault(); this.closest('form').submit();"><span class="bi bi-box-arrow-left"></span>&nbsp; Logout</a>
                </form>
              </li>
          </div>
        </nav>
    
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          @yield('section')
        </main>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="{{ asset('js/dashboard.js') }}"></script>
        @livewireScripts
    </body>
</html>
