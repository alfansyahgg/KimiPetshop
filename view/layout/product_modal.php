<!-- product -->


<?php 
$query = "select *,g.gambar from tbl_barang b inner join tbl_gambar g on b.id_barang = g.id_barang group by b.id_barang";
$result = mysqli_query($conn,$query);

while($data = mysqli_fetch_assoc($result)){
?>
<div class="modal fade" id="productModal<?=$data['id_barang'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
						<div class="modal-body modal-spa">
								<div class="col-md-5 span-2">
											<div class="item">
												<img src="<?= $baseURL."uploads/".$data['gambar'] ?>" class="img-responsive" alt="">
											</div>
								</div>
								<div class="col-md-7 span-1 ">
									<h3><?= ucwords(strtolower($data['nama_barang'])); ?></h3>
									<p class="in-para"> There are many variations of passages of Lorem Ipsum.</p>
									<div class="price_single">
									  <span class="reducedfrom "><del>$2.00</del>$1.50</span>
									
									 <div class="clearfix"></div>
									</div>
									<h4 class="quick">Quick Overview:</h4>
									<p class="quick_desc"> <?= ucwords(strtolower($data['deskripsi'])); ?></p>
									 <div class="add-to">
										   <button class="btn btn-danger my-cart-btn my-cart-b " data-id="<?=$data['id_barang'] ?>" data-name="<?=$data['nama_barang'] ?>" data-summary="<?=$data['deskripsi'] ?>" data-price="<?=$data['harga'] ?>" data-quantity="1" data-image="<?=$baseURL."uploads/".$data['gambar'] ?>" >Add to Cart</button>
										</div>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
<?php } ?>