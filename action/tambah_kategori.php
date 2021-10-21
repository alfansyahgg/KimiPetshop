<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

if(empty($_POST)){
    return;
}

$namaKategori = $_POST['nama_kategori'];

$query = "insert into tbl_kategori(nama_kategori) values('$namaKategori') ";
$exec = mysqli_query($conn,$query);

if($exec){
    header("Location: ".$baseURL."view/admin/manage_kategori.php");
}else{
    echo "failed";
}



?>