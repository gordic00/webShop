  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-light" id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand m-0" href="{{ url('/') }}" target="_self">
        <h2>DzEri</h2>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main"> 
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'navbar-light' : ''; }}" href="{{ route('dashboard.index') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10 text-dark">dashboard</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold ">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('categories') ? 'navbar-light' : ''; }} " href=" {{ route('categories.index') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10 text-dark">view_list</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold">Kategorije</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('categories/create') ? 'navbar-light' : ''; }}" href="{{ route('categories.create') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10 text-dark">addchart</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold">Nova Kategorija</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('products') ? 'navbar-light' : ''; }} " href=" {{ route('products.index') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10 text-dark">view_list</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold">Proizvodi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('products/create') ? 'navbar-light' : ''; }}" href="{{ route('products.create') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center text-dark">
              <i class="material-icons opacity-10 text-dark">addchart</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold">Novi proizvod</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('orders') ? 'navbar-light' : ''; }}" href="{{ route('orders.index') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10 bold text-dark">table_view</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold">Orders</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('users') ? 'navbar-light' : ''; }} " href="{{ url('users') }}">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10 bold text-dark">person</i>
            </div>
            <span class="nav-link-text ms-1 text-dark text-bold">Users</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>