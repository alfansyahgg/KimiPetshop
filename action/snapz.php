<?php 


include('connect.php');

require_once dirname(__FILE__) . './../plugins/Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-3NG-rd-IPdNDyX7fUSgyiVXY';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;


$order = $_POST['no_order'];

$queryNoOrder = 'select p.*,b.nama_barang,b.harga,(p.jml_barang*b.harga) as jml_harga ,g.gambar ,u.nama,u.email,u.no_hp,u.kota,u.kode_post,u.alamat,u.nama_belakang
from tbl_pemesanan p 
inner join tbl_barang b on p.id_barang = b.id_barang 
inner join tbl_gambar g on b.id_barang = g.id_barang 
inner join tbl_users u on p.id_users = u.id_users
where p.no_order = '.$order.' group by p.id_barang';


$hasil = mysqli_query($conn,$queryNoOrder) or die(mysqli_error($conn));;

// echo "<pre>";var_dump($hasil);exit();
$amount = 0;
$arr = [];

$nama = '';
$kota = '';
$kode_pos = '';
$alamat = '';
$email = '';
$no_hp = '';
$nama_belakang = '';

while($row = mysqli_fetch_assoc($hasil)){
	$arr[] = $row;
	$nama = $row['nama'];
	$kota = $row['kota'];
	$kode_pos = $row['kode_post'];
	$alamat = $row['alamat'];
	$email = $row['email'];
	$no_hp = $row['no_hp'];
	$nama_belakang = $row['nama_belakang'];
}

// foreach($arr as $key => $val){
// 	$amount += $val['jml_harga'];
// 	$item['id'] = $val['id_barang'];
// 	$item['price'] = $val['harga'];
// 	$item['quantity'] = $val['jml_barang'];
// 	$item['name'] = $val['nama_barang']; 
// }


for($i=0;$i <sizeof($arr);$i++){
	$amount += $arr[$i]['jml_harga'];
	$item[$i]['id'] = $arr[$i]['id_barang'];
	$item[$i]['price'] = $arr[$i]['harga'];
	$item[$i]['quantity'] = $arr[$i]['jml_barang'];
	$item[$i]['name'] = $arr[$i]['nama_barang']; 
}



$transaction_details = array(
'order_id' => $order,
'gross_amount' => $amount,
);

// $item1_details = array(
// 'id' => 'a1',
// 'price' => 20000,
// 'quantity' => 12,
// 'name' => "Denim shirt"
// );
// $item2_details = array(
// 'id' => 'a2',
// 'price' => 150000,
// 'quantity' => 1,
// 'name' => "Sweatshirt"
// );
$item_details = $item;
// echo "<pre>";print_r($item);exit();
$billing_address = array(
'first_name' => 'Dede',
'last_name' => 'Nurjanah',
'address' => $alamat,
'city' => $kota,
'postal_code' => $kode_pos,
'phone' => $no_hp,
'country_code' => 'IDN'
);
$shipping_address = array(
'first_name' => $nama,
'last_name' => $nama_belakang,
'address' => $alamat,
'city' => $kota,
'postal_code' => $kode_pos,
'phone' => $no_hp,
'country_code' => 'IDN'
);
$customer_details = array(
'first_name' => $nama,
'last_name' => $nama_belakang,
'email' => $email,
'phone' => $no_hp,
'billing_address' => $billing_address,
'shipping_address' => $shipping_address
);
$enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel','alfamart');
$transaction = array(
'transaction_details' => $transaction_details,
'customer_details' => $customer_details,
'item_details' => $item_details,
);

error_log(json_encode($transaction));
$snapToken = \Midtrans\Snap::getSnapToken($transaction);
error_log($snapToken);
echo $snapToken;
?>