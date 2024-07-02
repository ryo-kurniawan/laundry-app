<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Andra's Laundry</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AL</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('home') ? 'active' : ''}} ">
                <a href="{{ url('/home') }}"
                    class="nav-link  "><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Pengguna</li>
            <li class="nav-item {{ Request::is('pelanggan*') ? 'active' : ''}} ">
                <a href="{{ route('pelanggan.index') }}"
                    class="nav-link "><i class="fas fa-user"></i><span>Pengguna</span></a>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="nav-item {{ Request::is('transaksi*') ? 'active' : ''}} ">
                <a href="{{ route('transaksi.index') }}"
                    class="nav-link "><i class="fas fa-shopping-cart"></i><span>Transaksi</span></a>
            </li>
            <li class="nav-item {{ Request::is('riwayat*') ? 'active' : ''}} ">
                <a href="{{ route('riwayat') }}"
                    class="nav-link "><i class="fas fa-file"></i><span>Riwayat Transaksi</span></a>
            </li>

            <li class="menu-header">Laporan</li>
            <li class="nav-item {{ Request::is('laporan*') ? 'active' : ''}} ">
                <a href="{{ route('laporan') }}"
                    class="nav-link "><i class="fas fa-file"></i><span>Laporan</span></a>
            </li>
            <li class="menu-header">Setting</li>
            <li class="nav-item {{ Request::is('settings*') ? 'active' : ''}} ">
                <a href="{{ route('settings.index') }}"
                    class="nav-link "><i class="fas fa-cog"></i><span>Settings</span></a>
            </li>

        </ul>
    </aside>
</div>
