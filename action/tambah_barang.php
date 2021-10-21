<?php
include('connect.php');

// echo "<pre>";print_r($_FILES);exit();

if(empty($_POST)){
    return;
}

$queryIdBarang = "select max(id_barang) as max from tbl_barang";
$result = mysqli_query($conn,$queryIdBarang);
$fetch = mysqli_fetch_assoc($result);

$idBarang = empty($fetch) ? 0 : $fetch['max']+1;
$namaBarang = $_POST['nama'];
$hargaBarang = $_POST['harga'];
$stokBarang = $_POST['stok'];
$deskripsiBarang = $_POST['deskripsi'];
$kategoriBarang = $_POST['kategori'];


$total = count($_FILES['gambar']['name']);

$query = "insert into tbl_barang(id_barang,nama_barang,harga,stok,deskripsi,id_kategori) 
values($idBarang,'$namaBarang',$hargaBarang,$stokBarang,'$deskripsiBarang',$kategoriBarang) ";
$execute = mysqli_query($conn,$query);


$allowedExts = array("gif", "jpeg", "jpg", "png");
$extension = end(explode(".", $_FILES["gambar"]["name"]));

for( $i=0 ; $i < $total ; $i++ ) {

    $namaGambar = $_FILES['gambar']['name'][$i];
    $tmpFilePath = $_FILES['gambar']['tmp_name'][$i];

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $extension = explode(".", $_FILES["gambar"]["name"][$i]);
    $extension = end($extension);

    $fileSize = $_FILES['gambar']['size'][$i];

    if(in_array($extension,$allowedExts) && $tmpFilePath != "" && $fileSize < 500000 ){
        $newFilePath = "../uploads/" . $_FILES['gambar']['name'][$i];
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            $queryInsertGambar = "insert into tbl_gambar(id_barang,gambar) values($idBarang,'$namaGambar')";  
            $execute2 = mysqli_query($conn,$queryInsertGambar);
        }else{
            print_r($_FILES['gambar']['error']);
        }
    }
}
//end for

header("Location: ".$baseURL."view/admin/manage_barang.php");


?>