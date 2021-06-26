<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Borrowing Book</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">BK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= ($sidebar == 1) ? 'active' : ''; ?>"><a href="<?= route_to('view_dashboard'); ?>" class="nav-link"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li class="<?= ($sidebar == 2) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_buku'); ?>"><i class="fas fa-book"></i> <span>Data Buku</span></a></li>
            <li class="<?= ($sidebar == 3) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_kategori'); ?>"><i class="fas fa-book-open"></i> <span>Data Kategori Buku</span></a></li>
            <li class="<?= ($sidebar == 4) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_rakbuku'); ?>"><i class="fas fa-bookmark"></i> <span>Data Rak Buku</span></a></li>
            <li class="<?= ($sidebar == 5) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_penerbit'); ?>"><i class="fas fa-book-reader"></i> <span>Data Penerbit</span></a></li>
            <li class="<?= ($sidebar == 6) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_pengarang'); ?>"><i class="fas fa-atlas"></i> <span>Data Pengarang</span></a></li>
            <li class="<?= ($sidebar == 7) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_anggota'); ?>"><i class="fas fa-user-friends"></i> <span>Data Anggota</span></a></li>
            <?php if (session()->get('level') === 'admin') : ?>
                <li class="<?= ($sidebar == 8) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_pegawai'); ?>"><i class="fas fa-user-cog"></i> <span>Data Pegawai</span></a></li>
            <?php endif ?>
            <li class="menu-header">Transaksi</li>
            <li class="<?= ($sidebar == 9) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_transaksi'); ?>"><i class="fas fa-exchange-alt"></i> <span>Transaksi</span></a></li>
            <li class="<?= ($sidebar == 10) ? 'active' : ''; ?>"><a class="nav-link" href="<?= route_to('view_denda'); ?>"><i class="fas fa-hand-holding-usd"></i> <span>Denda</span></a></li>
        </ul>
    </aside>
</div>