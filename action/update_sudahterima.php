<?php
include('connect.php');

if(empty($_POST)){
    return;
}

$no_order = $_POST['no_order'];


$query = "update tbl_pemesanan set status_bayar='3' where no_order=".$no_order."";
$exec = mysqli_query($conn,$query) or die(mysqli_error($conn)) ;

if($exec){
    $data['status'] = true;
}else{
    $data['status'] = false;
}

echo json_encode($data);
// header("Location: ".$baseURL."view/admin/manage_kategori.php");

?>