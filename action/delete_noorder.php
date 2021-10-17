<?php 

include('connect.php');
session_start();
$order = $_GET['no'];


$query = "delete from tbl_pemesanan where no_order= ".$order." ";
$exec = mysqli_query($conn,$query);

if($exec){
	header("Location: ".$baseURL."customer/pesanan.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121'));
}else{
	echo "Gagal";
}









?>