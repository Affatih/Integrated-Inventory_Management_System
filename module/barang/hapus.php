<?php
// Pastikan file ini dipanggil lewat index.php
if(!defined('BASEPATH')) { die('Akses Langsung Dilarang!'); }

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // 1. Definisikan perintah hapus
    $query = "DELETE FROM data_barang WHERE id = '$id'";
    
    // 2. Eksekusi menggunakan variabel yang BENAR ($query)
    if($db->query($query)){ 
        $_SESSION['msg'] = "Data Berhasil Dihapus!";
        header("Location: index.php?page=barang_index");
        exit();
    } else {
        // Tambahkan ini biar kalau eror database lo tau kenapa
        die("Eror Database: " . $db->error);
    }
} else {
    header("Location: index.php?page=barang_index");
    exit();
}