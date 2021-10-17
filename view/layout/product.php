<?php
$query = "select *,g.gambar from tbl_barang b inner join tbl_gambar g on b.id_barang = g.id_barang group by b.id_barang order by b.id asc LIMIT 8";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
?>
<div class="col-md-3 pro-1 m-wthree xxproduk" data-id="<?= $row['id'] ?>" >
	<div class="col-m">
	<a href="#" data-toggle="modal" data-target="#productModal<?= $row['id_barang'] ?>" class="offer-img">
			<img src="<?= $baseURL."uploads/".$row['gambar'] ?>" class="img-responsive" alt="">
		</a>
		<div class="mid-1">
			<div class="women">
				<h6><a href="<?= $baseURL."customer/detail_products.php?id=".$row['id_barang'] ?>"><?= ucwords(strtolower($row['nama_barang'])); ?></a></h6>							
			</div>
			<div class="mid-2">
				<p ><em class="item_price">Rp. <?= number_format($row['harga'],0,0,'.') ?></em></p>
				<div class="clearfix"></div>
			</div>
			<div class="add add-2">
			   <button class="btn btn-danger my-cart-btn my-cart-b " data-id="<?=$row['id_barang'] ?>" data-name="<?=$row['nama_barang'] ?>" data-summary="<?=$row['deskripsi'] ?>" data-price="<?=$row['harga'] ?>" data-quantity="1" data-image="<?=$baseURL."uploads/".$row['gambar'] ?>" >Add to Cart</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>