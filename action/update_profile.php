<?php
include('connect.php');

// echo "<pre>";var_dump($_FILES);exit();

if(empty($_POST)){
    return;
}

$idUsers = $_POST['id_users'];
$emailUser = $_POST['email'];
$namaUser = trim($_POST['nama']);
$namaBelakang = trim($_POST['nama_belakang']);
$username = $_POST['username'];
$nohpUser = $_POST['no_hp'];
$pos = $_POST['pos'];
$kota = $_POST['kota'];
$alamatUser = $_POST['alamat'];

$namaGambar = $_FILES['gambar']['name'];

if(!empty($namaGambar)){

    $tmpFilePath = $_FILES['gambar']['tmp_name'];

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $extension = explode(".", $_FILES["gambar"]["name"]);
    $extension = end($extension);

    $fileSize = $_FILES['gambar']['size'];

    if(in_array($extension,$allowedExts) && $tmpFilePath != "" && $fileSize < 500000 ){
        $newFilePath = "../uploads/" . $_FILES['gambar']['name'];
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {

            $query = "update tbl_users set nama='$namaUser',nama_belakang='$namaBelakang',kota='$kota',kode_post='$pos',  username='$username' , email='$emailUser' ,no_hp='$nohpUser',alamat='$alamatUser',gambar='$namaGambar' where id_users=$idUsers";

            $execute = mysqli_query($conn,$query) or die(mysqli_error($conn));
        }else{
            print_r($_FILES['gambar']['error']);
        }
    }else{
        echo "Gambar Tidak Valid";exit();
    }
}else{
    $query = "update tbl_users set nama='$namaUser',nama_belakang='$namaBelakang',kota='$kota',kode_post='$pos',  username='$username' , email='$emailUser' ,no_hp='$nohpUser',alamat='$alamatUser' where id_users=$idUsers";

    $execute = mysqli_query($conn,$query) or die(mysqli_error($conn));
}


header("Location: ".$baseURL);

?>