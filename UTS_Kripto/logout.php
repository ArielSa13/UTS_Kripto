<?php
session_start(); // Pastikan Anda sudah memulai sesi sebelum menggunakan session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page or any other page after logout
header("Location: login.php");
exit();
?>
