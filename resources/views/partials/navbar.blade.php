<style>
 .t-nav {
          color: #222e64;
          transition: 0.2s;
        }

  .t-nav:hover{
    transform: scale(1.2);
    color: #ff9800;
  }

  .t-nav:active{
    background-color: transparent;
    border-bottom: 3px solid;
    border-radius: 10px;
  }
  .dropdown-menu{
    border: none;
  }
</style>

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container ">
      <a class="navbar-brand t-nav" href="/" >Tracer Study</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link t-nav" aria-current="page" href="/#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link t-nav" href="/#about">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link t-nav" href="/#statistik">Statistik</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle t-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Alumni
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item t-nav" href="/search">Pencarian Alumni</a></li>
              <li><a class="dropdown-item t-nav" href="/lacak">Pelacakan Alumni</a></li>
              {{-- <li><a class="dropdown-item" href="#">Galeri Alumni</a></li>
              <li><a class="dropdown-item" href="#">Pekerjaan Alumni</a></li> --}}
            </ul>
          </li>

          @auth
          {{-- <a class="nav-link" href="/logout">Logout</a> --}}
        <li class="nav-item dropdown" style="list-style: none">
          <a class="nav-link dropdown-toggle t-nav" id="login" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{auth()->user()->name}}
          </a>
          <ul class="dropdown-menu">
            @if (auth()->user()->name == "admin")
            <li><a class="dropdown-item btn t-nav" href="/admin/user">Halaman Admin</a></li>
            @else
            <li><a class="dropdown-item t-nav" href="/alumni">My Dashboard</a></li>
            @endif
  
            <form action="/logout" method="post">
              @csrf
              <li>
                <a class="dropdown-item p-1 t-nav" href="/logout">
                  <button class="btn m-0 " type="submit">Logout</button>
                </a>
              </li>
            </form>
          </ul>
        </li>  
        @else
        <a class="nav-link t-nav" id="login" href="/login">Login</a>
        @endauth
        </ul>
      </div>
    </div>
  </nav>