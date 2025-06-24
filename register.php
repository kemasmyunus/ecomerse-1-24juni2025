<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek apakah username sudah ada
    $cek = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Simpan user baru dengan role 'pelanggan'
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'pelanggan')");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $_SESSION['register_success'] = "Akun berhasil dibuat! Silakan login.";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="min-width: 350px;">
        <h3 class="mb-3 text-center">Register</h3>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Daftar</button>
            <a href="login.php" class="btn btn-link d-block text-center mt-2">Sudah punya akun? Login</a>
        </form>
    </div>
</div>

</body>
</html>
