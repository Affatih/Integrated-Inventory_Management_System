<?php
$user = $_SESSION['user'];

if (isset($_POST['submit'])) {
    $password_baru = $_POST['password_baru'];
    
    // Update password di database (Kita pakai teks biasa dulu agar Anda tidak pusing login lagi)
    $sql = "UPDATE users SET password = '{$password_baru}' WHERE id = '{$user['id']}'";
    
    if ($db->query($sql)) {
        echo "<script>alert('Password berhasil diganti!');</script>";
    } else {
        echo "Gagal update password!";
    }
}
?>

<div style="padding: 20px; background: white; border: 1px solid #ccc; max-width: 500px; margin: 20px auto;">
    <h3>Profil Owner Warung Madura</h3>
    <hr>
    <p><strong>Nama:</strong> <?= $user['nama']; ?></p>
    <p><strong>Username:</strong> <?= $user['username']; ?></p>
    
    <form method="post" style="margin-top: 20px; padding-top: 10px; border-top: 1px dashed #ccc;">
        <label>Ganti Password Baru:</label><br>
        <input type="text" name="password_baru" placeholder="Ketik password baru" required style="width: 100%; margin: 10px 0;">
        <button type="submit" name="submit" style="background: orange; border: none; padding: 10px; cursor: pointer;">Update Password</button>
    </form>
</div>