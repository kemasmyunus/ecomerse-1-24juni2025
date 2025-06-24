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
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require 'config/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $passwordUpdate = "";

    if (!empty($_POST['password'])) {
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $passwordUpdate = ", password='$passwordHash'";
    }

    $conn->query("UPDATE users SET username='$username', role='$role' $passwordUpdate WHERE id=$id");

    $_SESSION['pesan'] = "Pengguna berhasil diubah.";
    header("Location: data_user.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h3 class="mb-4">Edit Pengguna</h3>
    <form method="POST" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (biarkan kosong jika tidak diganti)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="pelanggan" <?= $data['role'] == 'pelanggan' ? 'selected' : '' ?>>Pelanggan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="data_user.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
