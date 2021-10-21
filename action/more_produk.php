<?php
include('connect.php');

// echo "<pre>";print_r($_FILES);exit();

$id_last = $_GET['l'];

$arr = [];
$query = "select *,g.gambar from tbl_barang b inner join tbl_gambar g on b.id_barang = g.id_barang where b.id_barang > $id_last group by b.id_barang order by b.id asc LIMIT 4";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
}
// echo "<pre>";print_r($arr);exit();
$more = '';
foreach($arr as $key => $val){
    $more .= '<div class="col-md-3 pro-1 m-wthree xxproduk" data-id="'.$val["id"].'" >';
    $more .= '<div class="col-m">';
    $more .= '<a href="#" data-toggle="modal" data-target="#productModal'.$val["id_barang"].'" class="offer-img">';
    $more .= '<img src="'.$baseURL.'uploads/'.$val["gambar"].'" class="img-responsive" alt="">';
    $more .= '</a>';

    $more .= '<div class="mid-1">';
    $more .= '<div class="women">';
    $more .= '<h6><a href="'.$baseURL.'view/customer/detail_products.php?id='.$val["id_barang"].'">'.ucwords(strtolower($val['nama_barang'])).'</a></h6>';
    $more .= '</div>';
    $more .= '<div class="mid-2"><p ><em class="item_price">Rp.'.number_format($val['harga'],0,0,'.').'</em></p><div class="clearfix"></div></div>';
    $more .= '<div class="add add-2">';
    $more .= '<button class="btn btn-danger my-cart-btn my-cart-b" data-id="'.$val["id_barang"].'"data-name="'.$val["nama_barang"].'" data-summary="'.$val["deskripsi"].'" data-price="'.$val["harga"].'" data-quantity="1" data-image="'.$baseURL.'uploads/'.$val["gambar"].'" >Add to Cart</button>';
    $more .= '</div></div></div></div>';
}
    $more .= '<script src="'.$baseURL.'assets/assets_customer/js/buttoncart.js'.'" ></script>';
echo $more;



?>