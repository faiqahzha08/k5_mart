<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">K5 Mart</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">

        <!-- Dashboard -->
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
             href="{{ route('dashboard') }}">
             Dashboard
          </a>
        </li>

        @if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin')
        <!-- Users (khusus Admin) -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" 
   href="{{ route('user.index') }}">
   User
        </a>
        </li>
        @endif

        <!-- Produk -->
        <li class="nav-item">
  <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" 
     href="{{ route('produk.index') }}">
     Produk
  </a>
</li>

 <li class="nav-item">
  <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" 
     href="{{ route('penjualan.index') }}">
     Penjualan
  </a>
</li>

      </ul>

      <!-- Logout -->
      <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>

    </div>
  </div>
</nav>
