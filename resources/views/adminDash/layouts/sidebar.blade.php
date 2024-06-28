<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{Request::is('admin/user*') ? 'active' : '' }} " aria-current="page" href="/admin/user">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('admin/biodata*') ? 'active' : '' }}" href="/admin/biodata">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Biodata
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('admin/pekerjaan*') ? 'active' : '' }}" href="/admin/pekerjaan">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Pekerjaan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('admin/laporan*') ? 'active' : '' }}" href="/admin/laporan">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Laporan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('admin/register*') ? 'active' : '' }}" href="/register">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Register
          </a>
        </li>
        
       
      </ul>

    </div>
  </nav>