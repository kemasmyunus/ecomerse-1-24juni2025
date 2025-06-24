<?php
session_start(); // Tambahkan ini jika belum ada
include 'config/db.php';

// Ambil data dari POST dan SESSION
$id = $_POST['id'];
$jumlah = (int) $_POST['jumlah'];
$id_user = $_SESSION['id_user']; // Pastikan user login dan session ini tersedia

// Ambil data barang
$barang = $conn->query("SELECT * FROM barang WHERE id=$id")->fetch_assoc();

if ($jumlah > $barang['stok']) {
    die("Jumlah melebihi stok");
}

$total = $barang['harga'] * $jumlah;

// Simpan ke barang_terjual termasuk id_user
$conn->query("INSERT INTO barang_terjual (barang_id, nama, deskripsi, jumlah, harga, total, gambar, id_user)
    VALUES ($id, '{$barang['nama']}', '{$barang['deskripsi']}', $jumlah, {$barang['harga']}, $total, '{$barang['gambar']}', $id_user)");

// Kurangi stok barang
$conn->query("UPDATE barang SET stok = stok - $jumlah WHERE id = $id");

header("Location: index.php");
?>
