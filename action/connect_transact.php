<?php
$servername = "localhost";
$database = "id17769544_db_olshop";
$username = "id17769544_alpublicapi";
$password = "@Babigokil12";
$baseURL = "http://localhost/olshop_petshop/";
// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>