<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: pelanggan.php");
    }
} else {
    header("Location: login.php");
}
?>
