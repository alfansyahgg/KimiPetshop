<?php
include('connect.php');

// echo "<pre>";print_r($_FILES);exit();

if(empty($_POST)){
    return;
}


$namaDepan = $_POST['nama'];
$namaBelakang = $_POST['nama_belakang'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$pos = $_POST['pos'];
$kota = $_POST['kota'];
$hak_akses = $_POST['hak_akses'];



$namaGambar = $_FILES['gambar']['name'];    
$tmpFilePath = $_FILES['gambar']['tmp_name'];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$extension = explode(".", $_FILES["gambar"]["name"]);
$extension = end($extension);

$fileSize = $_FILES['gambar']['size'];

if(in_array($extension,$allowedExts) && $tmpFilePath != "" && $fileSize < 500000 ){
    $newFilePath = "../uploads/" . $_FILES['gambar']['name'];
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

        $query = "insert into tbl_users(nama,nama_belakang,username,password,email,no_hp,alamat,kode_post,kota,hak_akses,gambar) 
            values('$namaDepan','$namaBelakang','$username','$password','$email', $no_hp,'$alamat','$pos','$kota','$hak_akses','$namaGambar')
         ";

        $execute = mysqli_query($conn,$query) or die(mysqli_error($conn));
    }else{
        print_r($_FILES['gambar']['error']);
    }
}else{
    echo "Gambar Tidak Valid";exit();
}


header("Location: ".$baseURL."admin/manage_user.php");


?>