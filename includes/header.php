<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<header class="d-flex justify-content-between align-items-center p-3 bg-dark text-white">
    <div class="d-flex align-items-center">
        <button id="toggleSidebar" class="btn btn-outline-light me-3">☰</button>
        <h4 class="m-0">Belanjaku.com</h4>
    </div>
    <div>
        <?= $_SESSION['username'] ?? 'Guest' ?> (<?= $_SESSION['role'] ?? 'none' ?>)
    </div>
</header>
<div class="d-flex">

