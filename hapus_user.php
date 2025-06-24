<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require 'config/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id = $id");

$_SESSION['pesan'] = "Pengguna berhasil dihapus.";
header("Location: data_user.php");
exit;
