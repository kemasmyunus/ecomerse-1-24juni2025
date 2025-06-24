<?php
session_start();

// Izinkan admin dan pelanggan
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'pelanggan' && $_SESSION['role'] !== 'admin')) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';
include 'includes/sidebar.php';
require 'config/db.php';
?>

<style>
.overlay-wrapper {
    position: relative;
}

.overlay-wrapper img {
    width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    border-radius: 0.5rem;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(30, 30, 30, 0.6);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    border-radius: 0.5rem;
}
</style>

<div class="container mt-4">
    <h2 class="mb-4">Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?></h2>
    <h4>Daftar Barang</h4>

    <div class="row">
        <?php
        $data = $conn->query("SELECT * FROM barang");
        while ($b = $data->fetch_assoc()):
            $stokKosong = $b['stok'] <= 0;
        ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 border shadow-sm p-2">
                    
                    <div class="overlay-wrapper">
                        <img 
                            src="uploads/<?= htmlspecialchars($b['gambar']) ?>" 
                            alt="<?= htmlspecialchars($b['nama']) ?>">
                        
                        <?php if ($stokKosong): ?>
                            <div class="overlay">Habis</div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body p-2">
                        <h6 class="card-title mb-1"><?= htmlspecialchars($b['nama']) ?></h6>
                        <p class="small mb-1 text-muted"><?= htmlspecialchars($b['deskripsi']) ?></p>
                        <p class="mb-1"><strong>Stok:</strong> <?= $b['stok'] ?></p>
                        <p class="mb-2"><strong>Rp<?= number_format($b['harga'], 0, ',', '.') ?></strong></p>

                        <form action="beli.php" method="POST">
                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <div class="mb-2">
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    class="form-control form-control-sm" 
                                    min="1" 
                                    max="<?= $b['stok'] ?>" 
                                    <?= $stokKosong ? 'disabled' : '' ?> 
                                    placeholder="Jumlah">
                            </div>
                            <button 
                                type="submit" 
                                class="btn btn-sm w-100 <?= $stokKosong ? 'btn-secondary' : 'btn-primary' ?>" 
                                <?= $stokKosong ? 'disabled' : '' ?>>
                                Beli
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
