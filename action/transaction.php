<?php

include('connect.php');
date_default_timezone_set('Asia/Jakarta');
session_start();


$penerima = $_POST['penerima'];
$nohp_penerima = $_POST['nohp'];
$kotaPenerima = $_POST['kota_penerima'];
$posPenerima = $_POST['pos_penerima'];
$alamatPenerima = $_POST['alamat'];
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
		insert into tbl_pemesanan(id_users,id_barang,jml_barang,no_order,tanggal_pemesanan,status_bayar,alamat_pengiriman,penerima,no_hp_penerima,kota_penerima,kode_post_penerima)
		values($idUser,$idBarang,$jumlahBarang,$noOrder,'$tanggalPesan','$statusBayar','$alamatPenerima','$penerima','$nohp_penerima','$kotaPenerima','$posPenerima')
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