<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="path_ke/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="container mt-4">
    <h2 class="mb-4">Data Barang</h2>

    <?php if (isset($_SESSION['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['pesan']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['pesan']); ?>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="tambah.php" class="btn btn-primary">Tambah Barang</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $barang = $conn->query("SELECT * FROM barang");
            while ($b = $barang->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($b['nama']) ?></td>
                    <td><?= htmlspecialchars($b['stok']) ?></td>
                    <td>Rp<?= number_format($b['harga'], 0, ',', '.') ?></td>
                    <td>
                        <?php if (!empty($b['gambar'])): ?>
                            <img src="uploads/<?= htmlspecialchars($b['gambar']) ?>" width="60" class="img-thumbnail">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= urlencode($b['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= urlencode($b['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
