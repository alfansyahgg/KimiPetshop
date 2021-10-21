<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

if(empty($_POST)){
    return;
}

$idKategori = $_POST['id_kategori'];
$namaKategori = $_POST['nama_kategori'];


$query = "update tbl_kategori set nama_kategori='$namaKategori' where id_kategori=$idKategori";
$exec = mysqli_query($conn,$query);


header("Location: ".$baseURL."view/admin/manage_kategori.php");

?>