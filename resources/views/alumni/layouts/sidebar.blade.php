<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{Request::is('dashboard') ? 'active' : '' }} " aria-current="page" href="/alumni">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('alumni/bios*') ? 'active' : '' }}" href="/alumni/bios">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Biodata
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('alumni/works*') ? 'active' : '' }}" href="/alumni/works">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Pekerjaan
          </a>
        </li>
       
      </ul>

    </div>
  </nav>