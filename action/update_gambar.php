<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

if(empty($_POST)){
    return;
}

$id_gambar = $_POST['id_gambar'];
$nama_gambar = $_POST['nama_gambar'];
$nama_barang = $_POST['nama_barang'];



$dir = '../uploads/' . $nama_gambar;

if(file_exists($dir)){
	unlink($dir);
}

$namaGambar = $_FILES['gambar']['name'];


$query = "update tbl_gambar set gambar='$namaGambar' where id_gambar=$id_gambar";
$exec = mysqli_query($conn,$query);

$tmpFilePath = $_FILES['gambar']['tmp_name'];

  if ($tmpFilePath != ""){
    $newFilePath = "../uploads/" . $_FILES['gambar']['name'];

    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

    //   echo "sukses";

    }
  }

header("Location: ".$baseURL."admin/manage_gambar.php");

?>