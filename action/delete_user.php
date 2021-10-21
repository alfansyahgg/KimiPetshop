<?php 

include('connect.php');

$id_users = $_GET['id'];


$query = "delete from tbl_users where id_users=$id_users";
$exec = mysqli_query($conn,$query);

if($exec){
	header("Location: ".$baseURL."view/admin/manage_user.php");
}else{
	echo "Gagal";
}









?>