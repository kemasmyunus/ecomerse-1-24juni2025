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
include 'config/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM barang WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/$gambar");
    } else {
        $gambar = $data['gambar'];
    }

    $conn->query("UPDATE barang SET 
        nama='$nama',
        deskripsi='$deskripsi',
        stok=$stok,
        harga=$harga,
        gambar='$gambar'
        WHERE id=$id");

    $_SESSION['pesan'] = "Barang berhasil diubah.";
    header("Location: admin.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h3 class="mb-4">Edit Barang</h3>
    <form method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <div class="mt-2">
                <img src="uploads/<?= htmlspecialchars($data['gambar']) ?>" width="120" class="img-thumbnail">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
