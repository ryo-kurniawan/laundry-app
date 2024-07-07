<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#"
                    data-toggle="sidebar"
                    class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#"
                    data-toggle="search"
                    class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">

        </div>
    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown dropdown-list-toggle"><a href="#"
                data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications

                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    @foreach ($transaksis as $t)
                    <a href="#"
                    class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-shirt"></i>
                    </div>
                    <div class="dropdown-item-desc">
                        <b>You</b> have new transaksi
                        <div class="time text-primary">{{ $t['idUser']['namalengkap'] }} - {{ $t['idPaket']['namapaket'] }}</div>
                    </div>
                </a>
                    @endforeach

                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ route('transaksi.index') }}">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="{{ asset('img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Session::get('name'); }} </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                <a href="{{ route('profile.index') }}"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>


                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
