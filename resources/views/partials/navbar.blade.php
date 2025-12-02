<nav class="navbar navbar-expand-lg fixed-top transition-all" style="transition: background-color 0.3s ease, box-shadow 0.3s ease;">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="/">
      {{-- <img src="{{ asset('img/logo.png') }}" alt="" width="30" height="24" class="d-inline-block align-text-top"> --}}
      <span class="fw-bold text-primary" style="letter-spacing: -0.5px;">Tracer Study</span>
    </a>
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav gap-lg-4 align-items-center">
        <li class="nav-item">
          <a class="nav-link fw-semibold text-dark" aria-current="page" href="/#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold text-dark" href="/#about">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold text-dark" href="/#statistik">Statistik</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Alumni
          </a>
          <ul class="dropdown-menu border-0 shadow-sm rounded-3 mt-2">
            <li><a class="dropdown-item py-2" href="/search">Pencarian Alumni</a></li>
            <li><a class="dropdown-item py-2" href="/lacak">Pelacakan Alumni</a></li>
          </ul>
        </li>

        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-dark" id="userDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2">
            @if (auth()->user()->name == "admin")
            <li><a class="dropdown-item py-2" href="/admin/user">Halaman Admin</a></li>
            @else
            <li><a class="dropdown-item py-2" href="/alumni">My Dashboard</a></li>
            @endif
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button class="dropdown-item py-2 text-danger" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </li>  
        @else
        <li class="nav-item ms-lg-2">
            <a class="btn btn-primary px-4 rounded-pill fw-semibold shadow-sm" href="/login">Login</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
