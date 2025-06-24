<?php
session_start();

// Cek login
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

// Debug opsional: tampilkan isi session
// echo "<pre>"; print_r($_SESSION); echo "</pre>";

include 'includes/header.php';
include 'includes/sidebar.php';
require 'config/db.php';

?>

<div class="container mt-4">
    <h2 class="mb-4">
        <?= $_SESSION['role'] === 'admin' ? 'Data Semua Pembelian' : 'Riwayat Pembelian Saya' ?>
    </h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <th>Nama Pembeli</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;

        if ($_SESSION['role'] === 'admin') {
            // Query untuk admin: semua pembelian + user info
            $sql = "SELECT bt.*, b.nama AS nama_barang, b.deskripsi AS deskripsi_barang, b.gambar AS gambar_barang, u.username 
                    FROM barang_terjual bt
                    JOIN barang b ON bt.barang_id = b.id
                    JOIN users u ON bt.id_user = u.id
                    ORDER BY bt.tanggal DESC";
        } else {
            // Query untuk pelanggan: hanya data milik sendiri
            $userId = $_SESSION['id_user'];
            $sql = "SELECT bt.*, b.nama AS nama_barang, b.deskripsi AS deskripsi_barang, b.gambar AS gambar_barang 
                    FROM barang_terjual bt
                    JOIN barang b ON bt.barang_id = b.id
                    WHERE bt.id_user = $userId
                    ORDER BY bt.tanggal DESC";
        }

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td><?= htmlspecialchars($row['deskripsi_barang']) ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                <td><img src="uploads/<?= htmlspecialchars($row['gambar_barang']) ?>" width="80" alt="gambar barang"></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                <?php endif; ?>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="<?= $_SESSION['role'] === 'admin' ? '9' : '8' ?>" class="text-center">Tidak ada data pembelian.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
