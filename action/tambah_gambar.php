<?php
include('connect.php');

// echo "<pre>";print_r($_FILES);exit();

if(empty($_POST)){
    return;
}


$idBarang = $_POST['id_barang']
$namaBarang = $_POST['nama_barang'];


$total = count($_FILES['gambar']['name']);


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

header("Location: ".$baseURL."view/admin/manage_gambar.php");


?>