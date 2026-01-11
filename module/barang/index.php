<?php
if(!defined('BASEPATH')) { die('Akses Langsung Dilarang!'); }

// 1. Logika Pagination (Kriteria Praktikum 13)
$batas = 5; // Tampilkan 5 data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$search = isset($_GET['search']) ? $_GET['search'] : '';

// 2. Query Data (Gabung Search & Pagination)
if ($search) {
    $query_sql = "SELECT * FROM data_barang WHERE nama LIKE '%$search%' OR kategori LIKE '%$search%'";
} else {
    $query_sql = "SELECT * FROM data_barang";
}

// Hitung total data untuk jumlah tombol halaman
$all_data = $db->query($query_sql);
$jumlah_data = $all_data->num_rows;
$total_halaman = ceil($jumlah_data / $batas);

// Ambil data dengan LIMIT
$data_barang = $db->query("$query_sql ORDER BY id DESC LIMIT $halaman_awal, $batas");
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Manajemen Stok Barang</h4>
            <p class="text-muted small mb-0">Total <?= $jumlah_data; ?> produk tersedia.</p>
        </div>
        <a href="index.php?page=barang_tambah" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus me-2"></i>Tambah Produk
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="index.php" method="GET" class="row g-2">
                <input type="hidden" name="page" value="barang_index">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama barang atau kategori..." value="<?= $search; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light small text-uppercase">
                    <tr>
                        <th class="px-4 py-3">Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($data_barang->num_rows > 0): ?>
                        <?php while($row = $data_barang->fetch_assoc()): ?>
                        <tr>
                            <td class="px-4">
                                <span class="fw-bold text-dark d-block"><?= $row['nama']; ?></span>
                                <small class="text-muted">ID: #<?= $row['id']; ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border fw-normal"><?= $row['kategori']; ?></span></td>
                            <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                            <td>
                                <?php if($row['stok'] <= 5): ?>
                                    <span class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-1"></i><?= $row['stok']; ?></span>
                                <?php else: ?>
                                    <span class="text-dark"><?= $row['stok']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=barang_edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-light border" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="index.php?page=barang_hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Hapus barang ini?')" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted">Data tidak ditemukan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-top py-3">
            <nav>
                <ul class="pagination pagination-sm justify-content-center mb-0">
                    <li class="page-item <?= ($halaman <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="index.php?page=barang_index&halaman=<?= $halaman - 1; ?>&search=<?= $search; ?>"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    
                    <?php for($x=1; $x<=$total_halaman; $x++): ?>
                        <li class="page-item <?= ($halaman == $x) ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?page=barang_index&halaman=<?= $x; ?>&search=<?= $search; ?>"><?= $x; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="index.php?page=barang_index&halaman=<?= $halaman + 1; ?>&search=<?= $search; ?>"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>