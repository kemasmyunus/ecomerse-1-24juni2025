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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    $_SESSION['pesan'] = "Pengguna berhasil ditambahkan.";
    header("Location: data_user.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h3 class="mb-4">Tambah Pengguna</h3>
    <form method="POST" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="pelanggan">Pelanggan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="data_user.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
