<?php 
if(!defined('BASEPATH')) die('Akses Dilarang'); 

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = $db->query("SELECT * FROM data_barang WHERE id = '$id'");
$data = $query->fetch_assoc();

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $sql = "UPDATE data_barang SET nama='$nama', kategori='$kategori', harga_jual='$harga', stok='$stok' WHERE id='$id'";
    
    if($db->query($sql)){
        header("Location: index.php?page=barang_index");
        exit();
    }
}
?>

<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="index.php?page=barang_index" class="btn btn-outline-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" title="Batal">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="ms-3">
            <h4 class="fw-bold mb-0">Edit Produk</h4>
            <p class="text-muted small mb-0">Mengubah data: <strong><?= $data['nama']; ?></strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-top: 4px solid #fd7e14;">
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="ROKOK" <?= ($data['kategori'] == 'ROKOK') ? 'selected' : ''; ?>>ROKOK</option>
                                <option value="SEMBAKO" <?= ($data['kategori'] == 'SEMBAKO') ? 'selected' : ''; ?>>SEMBAKO</option>
                                <option value="MINUMAN" <?= ($data['kategori'] == 'MINUMAN') ? 'selected' : ''; ?>>MINUMAN</option>
                                <option value="JAJANAN" <?= ($data['kategori'] == 'JAJANAN') ? 'selected' : ''; ?>>JAJANAN</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Harga Jual (Rp)</label>
                                <input type="number" name="harga_jual" class="form-control" value="<?= $data['harga_jual']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Stok Saat Ini</label>
                                <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-warning fw-bold text-white" style="background-color: #fd7e14; border: none;">
                                <i class="fas fa-sync-alt me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>