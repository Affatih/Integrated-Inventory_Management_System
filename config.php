<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pengaturan Database
$config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'db_name' => 'Warung_madura'
];

// Base URL agar link tidak patah
$base_url = "/warung_madura/";

// Proteksi Session: Jangan taruh header redirect di sini 
// karena config dipanggil di SETIAP file (termasuk login).
// Proteksi cukup kita taruh di index.php saja supaya tidak bentrok.