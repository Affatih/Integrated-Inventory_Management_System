<?php
session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/'); // Hapus cookie session di browser
header("Location: /warung_madura/index.php?page=login");
exit();