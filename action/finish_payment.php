<?php

include('connect.php');
session_start();
if(empty($_POST)){
	return;
}

$no_order = $_POST['no_order'];
$result = json_decode($_POST['result_data'],true);
date_default_timezone_set("Asia/Jakarta");

// echo "<pre>";var_dump($result);exit();

$transaction_id = $result['transaction_id'];
$gross_amount = $result['gross_amount'];
$payment_type = $result['payment_type'];
$transaction_time = $result['transaction_time'];
$transaction_status = $result['transaction_status'];
$bank = empty($result['va_numbers'][0]['bank']) ? '' : $result['va_numbers'][0]['bank'];
$va_number = empty($result['va_numbers'][0]['va_number']) ? '' : $result['va_numbers'][0]['va_number'];
$fraud_status = $result['fraud_status'];
$bca_va_number = empty($result['bca_va_number']) ? '' : $result['bca_va_number'];
$permata_va_number = empty($result['permata_va_number']) ? '' : $result['permata_va_number'];
$pdf_url = $result['pdf_url'];
$status_code = $result['status_code'];
$payment_code = empty($result['payment_code']) ? '' : $result['payment_code'];

$bill_key = empty($result['bill_key']) ? '' : $result['bill_key'];
$biller_code = empty($result['biller_code']) ? '' : $result['biller_code'];

$batas_bayar = date('Y-m-d H:i:s',strtotime('now +1 hour'));
// echo "<pre>";var_dump($batas_bayar);exit();

$queryInsert = "insert into tbl_transaksi(no_order,transaction_id,gross_amount,payment_type,batas_bayar,transaction_status,bank,va_number,fraud_status,bca_va_number,permata_va_number,pdf_url,bill_key,biller_code,payment_code,status)

	values($no_order,'$transaction_id',$gross_amount,'$payment_type','$batas_bayar','$transaction_status','$bank','$va_number','$fraud_status','$bca_va_number','$permata_va_number','$pdf_url','$bill_key','$biller_code', '$payment_code','$status_code')

  ";
  $exec = mysqli_query($conn,$queryInsert) or die(mysqli_error($conn));

if($exec){
	header("Location: ".$baseURL."view/customer/pesanan.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121'));
}else{
	echo "error";
}

// $data = 
// [
// 	'order_id' => $result->order_id,
// 	'gross_amount' => $result->gross_amount,
// 	'payment_type' => $result->payment_type,
// 	'transaction_time' => $result->transaction_time,
// 	'transaction_status' => $result->transaction_status,
// 	// 'batas_bayar' => 
// 	'bank' => $result->va_numbers[0]->bank,
// 	'va_number' => $result->va_numbers[0]->va_number,
// 	'fraud_status' => $result->fraud_status,
// 	'bca_va_number' => $result->bca_va_number,
// 	'permata_va_number' => $result->permata_va_number,
// 	'pdf_url' => $result->pdf_url,
// 	'status_code' => $result->status_code,
// ];

// echo "<pre>";var_dump($data);exit();

?>