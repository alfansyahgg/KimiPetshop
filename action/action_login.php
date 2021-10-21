<?php

include 'connect.php';
session_start();

$username = mysqli_real_escape_string($conn,stripslashes(strip_tags(htmlspecialchars($_POST['username']))));
$password = mysqli_real_escape_string($conn,stripslashes(strip_tags(htmlspecialchars($_POST['password']))));

$query = "select * from tbl_users where username='$username'";
$result = mysqli_query($conn,$query);
$fetch = mysqli_fetch_assoc($result);
// echo "<pre>";print_r($fetch);exit();
if($result->num_rows > 0){
    if(password_verify($password, $fetch['password'])){
        $_SESSION['id_user'] = $fetch['id_users'];
        $_SESSION['is_login'] = true;
        $_SESSION['nama'] = $fetch['nama'];
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['no_hp'] = $fetch['no_hp'];
        $_SESSION['kota'] = $fetch['kota'];
        $_SESSION['kode_post'] = $fetch['kode_post'];
        $_SESSION['alamat'] = $fetch['alamat'];
        $_SESSION['gambar'] = $fetch['gambar'];
        $_SESSION['hak_akses'] = $fetch['hak_akses'];
        if($fetch['hak_akses'] == '0'){
            header("Location: ".$baseURL."view/customer/profil.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121'));
        }else{
            // echo "<pre>";var_dump($_SESSION);exit();
            header("Location: ".$baseURL."dashboard.php");
        }

    }else{
        session_destroy();
        header("Location: ".$baseURL."login.php");
    }
}else{
    session_destroy();
    header("Location: ".$baseURL."login.php");
}


?>
