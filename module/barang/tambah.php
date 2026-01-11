<?php
if(!defined('BASEPATH')) { die('Akses Langsung Dilarang!'); }

// LOGIKA SIMPAN (Karena lo gak pake file aksi terpisah)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_barang'])) {
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga_jual'];
    $stok     = $_POST['stok'];

    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, stok) 
            VALUES ('$nama', '$kategori', '$harga', '$stok')";
    
    if ($db->query($sql)) {
        // Balikin ke halaman stok barang
        header("Location: index.php?page=barang_index");
        exit();
    } else {
        echo "<script>alert('Gagal Simpan Data!');</script>";
    }
}
?>

<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="index.php?page=barang_index" class="btn btn-outline-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="ms-3">
            <h4 class="fw-bold mb-0">Tambah Produk Baru</h4>
            <p class="text-muted small mb-0">Input data ke gudang Warung Madura.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-top: 4px solid #0d6efd;">
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Roma Kelapa" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="ROKOK">ROKOK</option>
                                <option value="SEMBAKO">SEMBAKO</option>
                                <option value="MINUMAN">MINUMAN</option>
                                <option value="JAJANAN">JAJANAN</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Harga Jual (Rp)</label>
                                <input type="number" name="harga_jual" class="form-control" placeholder="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Stok Awal</label>
                                <input type="number" name="stok" class="form-control" placeholder="0" required>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        <div class="d-grid">
                            <button type="submit" name="simpan_barang" class="btn btn-primary fw-bold">
                                <i class="fas fa-save me-2"></i>Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>