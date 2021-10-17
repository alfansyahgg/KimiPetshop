<?php

include 'connect.php';
session_start();

$namaDepan = $_POST['depan'];
$namaBelakang = $_POST['belakang'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$query = "insert into tbl_users(nama,nama_belakang,username,password)
		values('$namaDepan','$namaBelakang','$username','$password')
 ";

 $exec = mysqli_query($conn,$query);
 if($exec){
 	header("Location: ".$baseURL."login.php")
 }else{
 	echo 'gagal';exit();
 }

?>