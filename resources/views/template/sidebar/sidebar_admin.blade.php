<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.buku', ['action' => 'show']) }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    Buku
                </a>
                <a class="nav-link" href="{{ route('admin.kategori', ['action' => 'show']) }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    Kategori Buku
                </a>
                <a class="nav-link" href="{{ route('admin.penulis', ['action' => 'show']) }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-pencil"></i>
                    </div>
                    Penulis
                </a>
                <a class="nav-link" href="{{ route('admin.penerbit', ['action' => 'show']) }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-house"></i>
                    </div>
                    Penerbit
                </a>
                <a class="nav-link" href="{{ route('admin.peminjaman', ['action' => 'show']) }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-hand"></i>
                    </div>
                    Peminjaman
                </a>
                <a class="nav-link" href="{{ route('admin.pengaturan') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-gear"></i>
                    </div>
                    Pengaturan
                </a>
                <a class="nav-link" href="{{ route('action.logout') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-right-from-bracket"></i>
                    </div>
                    Logout
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->user_username }}
        </div>
    </nav>
</div>
