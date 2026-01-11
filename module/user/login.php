<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $db->get("users", "username='$username'");
    $user = $query->fetch_assoc();

    if ($user && $password == $user['password']) {
        $_SESSION['isLogin'] = true;
        $_SESSION['user'] = $user;
        
        echo "<script>window.location.href='index.php?page=barang_index';</script>";
        exit();
    } else {
        echo "<div class='alert alert-danger'>LOGIN GAGAL!</div>";
    }
}
?>
<form method="post" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="submit">LOGIN</button>
</form>