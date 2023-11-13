<?php
require_once('koneksi.php');
require_once('hill_cipher.php');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $errorMessage = "Registrasi Gagal: Username sudah terdaftar.";
    } else {
        // Kuncu Matriks
        $key = [[2, 1], [3, 4]];
        $encryptedPassword = hill_cipher($password, $key, 'encrypt');

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$encryptedPassword')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $errorMessage = "Registrasi Berhasil.";
        } else {
            $errorMessage = "Registrasi Gagal: " . mysqli_error($koneksi);
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>  
    <div class="login-page">
        <div class="form">
            <h2>Registrasi</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="username" placeholder="username" required />
                <input type="password" name="password" placeholder="password" required />
                <button type="submit" name="register">Daftar</button>
                <p class="error-message"><?php echo $errorMessage; ?></p>
                <p class="message">Sudah Memiliki Akun? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>