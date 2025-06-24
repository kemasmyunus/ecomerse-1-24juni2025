<?php
session_start();
include 'config/db.php';

$id = $_GET['id'];

// Hapus gambar dari folder uploads
$data = $conn->query("SELECT gambar FROM barang WHERE id = $id")->fetch_assoc();
if ($data && !empty($data['gambar']) && file_exists("uploads/" . $data['gambar'])) {
    unlink("uploads/" . $data['gambar']);
}

// Hapus data dari database
$conn->query("DELETE FROM barang WHERE id = $id");

// Set pesan sukses
$_SESSION['pesan'] = "Barang berhasil dihapus.";

// Redirect ke halaman admin
header("Location: admin.php");
exit;
