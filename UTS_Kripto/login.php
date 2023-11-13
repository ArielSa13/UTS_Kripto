<?php
require_once('koneksi.php');
require_once('hill_cipher.php');

$errorMessage = ''; // Inisialisasi variabel pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kunci Matriks
    $key = [[2, 1], [3, 4]];
    $encryptedPassword = hill_cipher($password, $key, 'encrypt');

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$encryptedPassword'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Redirect to home.php after successful login
        header("Location: home.php");
        exit();
    } else {
        $errorMessage = "Login gagal. Username atau Password Salah";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-page">
        <div class="form">
            <h2>Login   </h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="username" placeholder="username" required />
                <input type="password" name="password" placeholder="password" required />
                <button type="submit" name="login">Login</button>
                <p class="error-message"><?php echo $errorMessage; ?></p>
                <p class="message">Belum Memiliki Akun? <a href="register.php">Daftar</a></p>
            </form>
        </div>
    </div>
</body>
</html>