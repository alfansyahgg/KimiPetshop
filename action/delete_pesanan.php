<?php 

include('connect.php');

session_start();
$idPesanan = $_GET['p'];


$query = "delete from tbl_pemesanan where id_pemesanan=$idPesanan";
$exec = mysqli_query($conn,$query);

if($exec){
	header("Location: ".$baseURL."view/customer/pesanan.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121'));
}else{
	echo "Gagal";
}









?>