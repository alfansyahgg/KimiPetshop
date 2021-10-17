<?php 

include('connect.php');

$idKategori = $_GET['id'];


$query = "delete from tbl_kategori where id_kategori=$idKategori";
$exec = mysqli_query($conn,$query);

if($exec){
	header("Location: ".$baseURL."admin/manage_kategori.php");
}else{
	echo "Gagal";
}









?>