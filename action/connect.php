<?php
$servername = "localhost";
$database = "olshop_petshop";
$username = "root";
$password = "";
$baseURL = "http://localhost/kimi-petshop/";
// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>