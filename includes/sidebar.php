<aside id="sidebar" class="bg-dark text-white d-flex flex-column sidebar">

    <ul class="nav flex-column px-2">
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <li class="nav-item">
                <a href="admin.php" class="nav-link text-white d-flex align-items-center">
                    <i class="fas fa-boxes me-2"></i>
                    <span class="sidebar-label">Data Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="data_penjualan.php" class="nav-link text-white d-flex align-items-center">
                    <i class="fas fa-receipt me-2"></i>
                    <span class="sidebar-label">Data Pembelian</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="data_user.php" class="nav-link text-white d-flex align-items-center">
                    <i class="fas fa-users me-2"></i>
                    <span class="sidebar-label">Data Pengguna</span>
                </a>
            </li>
        <?php elseif ($_SESSION['role'] === 'pelanggan'): ?>
            <li class="nav-item">
                <a href="pelanggan.php" class="nav-link text-white d-flex align-items-center">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <span class="sidebar-label">Beli</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="data_penjualan.php" class="nav-link text-white d-flex align-items-center">
                    <i class="fas fa-history me-2"></i>
                    <span class="sidebar-label">Riwayat</span>
                </a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger d-flex align-items-center">
                <i class="fas fa-sign-out-alt me-2"></i>
                <span class="sidebar-label">Logout</span>
            </a>
        </li>
    </ul>
</aside>
