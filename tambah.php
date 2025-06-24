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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $conn->query("INSERT INTO barang (nama, deskripsi, stok, harga) VALUES ('$nama', '$deskripsi', $stok, $harga)");
    $id = $conn->insert_id;

    if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaFileBaru = "$id.$ext";
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/$namaFileBaru");
        $conn->query("UPDATE barang SET gambar = '$namaFileBaru' WHERE id = $id");
    }

    $_SESSION['pesan'] = "Barang berhasil ditambahkan.";
    header("Location: admin.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h3 class="mb-4">Tambah Barang</h3>
    <form method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
