<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

if(empty($_POST)){
    return;
}

$idUsers = $_POST['id_users'];
$password = $_POST['password'];

$password = password_hash($password, PASSWORD_DEFAULT);

$query = "update tbl_users set password='$password' where id_users=$idUsers";
$exec = mysqli_query($conn,$query);


header("Location: ".$baseURL);

?>