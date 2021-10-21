<?php 

include('connect.php');

$idBarang = $_GET['id'];


$query = "delete from tbl_barang where id_barang=$idBarang";
$exec = mysqli_query($conn,$query);

$queryGambar = "delete from tbl_gambar where id_barang=$idBarang";
$exec2 = mysqli_query($conn,$queryGambar);

if($exec){
	header("Location: ".$baseURL."view/admin/manage_barang.php");
}else{
	echo "Gagal";
}









?>