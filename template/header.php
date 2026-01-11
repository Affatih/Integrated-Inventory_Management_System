<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Madura - Manajemen Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .navbar { margin-bottom: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .container-main { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); min-height: 400px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard">WARUNG MADURA</a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <?php if (isset($_SESSION['isLogin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['page'] == 'barang_index') ? 'active' : ''; ?>" href="index.php?page=barang_index">Stok Barang</a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['isLogin'])): ?>
                    <li class="nav-item">
                        <span class="nav-link text-info">Admin: <?= isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : 'Admin'; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm ms-2" href="index.php?page=logout">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container container-main">