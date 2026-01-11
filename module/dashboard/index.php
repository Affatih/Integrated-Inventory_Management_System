<?php
if(!defined('BASEPATH')) { die('Akses Langsung Dilarang!'); }

// Hitung Statistik
$total_jenis = $db->query("SELECT COUNT(*) as total FROM data_barang")->fetch_assoc()['total'];
$aset_query = $db->query("SELECT SUM(harga_jual * stok) as total_aset FROM data_barang")->fetch_assoc();
$total_aset = $aset_query['total_aset'] ?? 0;
$stok_kritis = $db->query("SELECT * FROM data_barang WHERE stok <= 5 ORDER BY stok ASC");
$jumlah_kritis = $stok_kritis->num_rows;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Ringkasan Sistem</h4>
        <p class="text-muted small mb-0">Data stok Warung Madura hari ini.</p>
    </div>
    <a href="index.php?page=barang_index" class="btn btn-outline-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" title="Kembali">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 5px solid #0d6efd;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light text-primary p-3 rounded">
                            <i class="fas fa-box fa-lg"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Jenis Produk</p>
                            <h3 class="mb-0 fw-bold"><?= $total_jenis; ?> <span class="text-muted fs-6 fw-normal">Item</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 5px solid #198754;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light text-success p-3 rounded">
                            <i class="fas fa-wallet fa-lg"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Estimasi Aset</p>
                            <h3 class="mb-0 fw-bold">Rp <?= number_format($total_aset, 0, ',', '.'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 5px solid #dc3545;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-light text-danger p-3 rounded">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Perlu Belanja</p>
                            <h3 class="mb-0 fw-bold"><?= $jumlah_kritis; ?> <span class="text-muted fs-6 fw-normal">Produk</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold"><i class="fas fa-clipboard-list me-2"></i>Daftar Belanja (Stok Habis)</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light small text-uppercase">
                        <tr>
                            <th class="px-4 py-3">Nama Barang</th>
                            <th>Kategori</th>
                            <th>Sisa</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($jumlah_kritis > 0): ?>
                            <?php while($row = $stok_kritis->fetch_assoc()): ?>
                            <tr>
                                <td class="px-4"><?= $row['nama']; ?></td>
                                <td><span class="text-muted small"><?= $row['kategori']; ?></span></td>
                                <td><span class="text-danger fw-bold"><?= $row['stok']; ?></span></td>
                                <td class="text-center">
                                    <a href="index.php?page=barang_edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-link text-decoration-none">Update Stok</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    Semua stok masih mencukupi.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>