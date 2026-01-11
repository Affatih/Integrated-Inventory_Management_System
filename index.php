<?php
session_start();
ob_start();
define('BASEPATH', true); 

include_once 'config.php';
include_once 'class/Database.php';
$db = new Database($config);

// Ambil halaman, sekarang defaultnya kita arahkan ke dashboard
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// PROTEKSI SESSION
if ($page !== 'login') {
    if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
        header("Location: index.php?page=login");
        exit();
    }
}

include_once 'template/header.php';

// ROUTING PUSAT
switch ($page) {
    case 'dashboard': // 1. TAMBAHKAN CASE DASHBOARD
        include 'module/dashboard/index.php';
        break;
    case 'login':
        include 'module/user/login.php';
        break;
    case 'barang_index':
        include 'module/barang/index.php';
        break;
    case 'barang_tambah':
        include 'module/barang/tambah.php';
        break;
    case 'barang_edit':
        include 'module/barang/ubah.php'; 
        break;
    case 'barang_hapus':
        include 'module/barang/hapus.php';
        break;
    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        exit();
    default:
        // 2. DEFAULT JUGA DIARAHKAN KE DASHBOARD (Setelah Login)
        include 'module/dashboard/index.php';
        break;
}

include_once 'template/footer.php';
ob_end_flush();