<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kripto";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
