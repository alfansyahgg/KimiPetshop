<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

if(empty($_POST)){
    return;
}

$idBarang = $_POST['id_barang'];
$namaBarang = $_POST['nama'];
$hargaBarang = $_POST['harga'];
$stokBarang = $_POST['stok'];
$deskripsiBarang = $_POST['deskripsi'];
$kategoriBarang = $_POST['kategori'];


$query = "update tbl_barang set nama_barang='$namaBarang',harga=$hargaBarang,stok=$stokBarang,
                deskripsi='$deskripsiBarang',id_kategori=$kategoriBarang where id_barang=$idBarang";

// echo "<pre>";print_r($query);exit();
$execute = mysqli_query($conn,$query);

if($execute){
    header("Location: ".$baseURL."view/admin/manage_barang.php");
}else{
    echo "error";
}


?>