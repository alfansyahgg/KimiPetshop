<?php

include('connect.php');

if(empty($_POST)){
	echo "gagal";exit();
}

$statusBayar = $_POST['status_bayar'];
$no_order	= $_POST['no_order'];

$queryUpdate = "update tbl_pemesanan set status_bayar='$statusBayar' where no_order=$no_order ";

if(mysqli_query($conn,$queryUpdate)){
	$data['status'] = true;
}else{
	$data['status'] = false;
}

echo json_encode($data);

?>