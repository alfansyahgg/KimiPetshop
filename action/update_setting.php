<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

if(empty($_POST)){
    return;
}

$deskripsi = $_POST['deskripsi'];
$alamat = $_POST['alamat'];
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$telp = $_POST['telp'];
$email = $_POST['email'];



$query = "update tbl_setting set deskripsi='$deskripsi',alamat='$alamat',facebook='$facebook',twitter='$twitter',telp='$telp',email='$email' where id = 1";
$exec = mysqli_query($conn,$query);


header("Location: ".$baseURL."view/admin/manage_web.php");

?>