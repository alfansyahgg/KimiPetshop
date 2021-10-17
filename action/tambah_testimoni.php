<?php
include('connect.php');

// echo "<pre>";print_r($_POST);exit();

session_start();
if(empty($_POST)){
    return;
}

$id_users = $_SESSION['id_user'];
$no_order = $_POST['order'];
$bintang = $_POST['bintang'];
$keterangan = $_POST['keterangan'];

$query = "insert into tbl_testimoni(id_users,no_order,bintang,keterangan) values($id_users,$no_order,$bintang,'$keterangan') ";
$exec = mysqli_query($conn,$query);

if($exec){
    header("Location: ".$baseURL);
}else{
    echo "failed";
}



?>