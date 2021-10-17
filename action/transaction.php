<?php

include('connect.php');
date_default_timezone_set('Asia/Jakarta');
session_start();




$products = $_POST['products'];

$idUser 			= $_SESSION['id_user'];
$usernamePembeli	= $_SESSION['username'];
$namaPembeli 		= $_SESSION['nama'];
$alamatPembeli 		= $_SESSION['alamat'];

$statusBayar		= '0';
$date = date('m/d/Y h:i:s a', time());
$tanggalPesan = date('Y-m-d H:i:s',time());

$noOrder = rand(10000,99999);

foreach($_POST['products'] as $post){
	$idBarang 				= $post['id'];
	$namaBarang 			= $post['name'];
	$deskripsi 				= $post['summary'];
	$hargaBarang 			= $post['price'];
	$jumlahBarang 			= $post['quantity'];
	$gambarBarang 			= $post['image'];

	$queryPesan = "
		insert into tbl_pemesanan(id_users,id_barang,jml_barang,no_order,tanggal_pemesanan,status_bayar,alamat_pengiriman)
		values($idUser,$idBarang,$jumlahBarang,$noOrder,'$tanggalPesan','$statusBayar','$alamatPembeli')
	";
	$exec = mysqli_query($conn,$queryPesan);
	if($exec){
		$data['status'] = true;
		$data['pesan'] = 'Berhasil Pesan';
	}else{
		$data['status'] = false;
		$data['pesan'] = 'Gagal';
	}
}

echo json_encode($data);

?>