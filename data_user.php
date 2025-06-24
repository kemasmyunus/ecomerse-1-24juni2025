<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';
include 'includes/sidebar.php';
require 'config/db.php';
?>

<div class="container mt-4">
    <h2 class="mb-4">Data Pengguna</h2>
    <?php if (isset($_SESSION['pesan'])): ?>
        <div class="alert alert-success"><?= $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
    <?php endif; ?>

    <a href="tambah_user.php" class="btn btn-primary mb-3">Tambah Pengguna</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $result = $conn->query("SELECT * FROM users ORDER BY id ASC");
        while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= $row['role'] ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_user.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
