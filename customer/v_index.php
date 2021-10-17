<div class="container ">
    <div class="spec ">
        <h3>Our Products</h3>
        <div class="ser-t">
            <b></b>
            <span><i></i></span>
            <b class="line"></b>
        </div>
    </div>
        <div class="tab-head ">
        <nav class="nav-sidebar">
					<ul class="nav tabs ">
					<?php 
					$no=1;
					$query = "select * from tbl_kategori";
					$result = mysqli_query($conn,$query);
					while($row = mysqli_fetch_assoc($result)){
					?>
					<li class=""><a href="#tab<?=$row['id_kategori']; ?>" data-toggle="tab"><?= $row['nama_kategori']; ?></a></li>
					
					<?php } ?>
					</ul>
				</nav>
				<div class=" tab-content tab-content-t ">
					<?php 
					$no=1;
					$query = "select * from tbl_kategori";
					$result = mysqli_query($conn,$query);
					while($row = mysqli_fetch_assoc($result)){
					?>
					<div class="tab-pane text-style" id="tab<?=$row['id_kategori']; ?>">
						<div class="con-w3l" style="display: flex;flex-wrap: wrap;">
							<?php 
							$id_row = $row['id_kategori'];
							$query2 = "select *,g.gambar from tbl_barang b inner join tbl_gambar g on b.id_barang = g.id_barang where id_kategori=$id_row group by b.id_barang";
							$result2 = mysqli_query($conn,$query2);
							$count = 0;
							while($data = mysqli_fetch_assoc($result2)){
								if($data['id_kategori'] == $id_row ){
									$count++;
									if($count == 5){break;}
							?>
							<div class="col-md-3 m-wthree">
								<div class="col-m">								
									<a href="#" data-toggle="modal" data-target="#productModal<?=$data['id_barang'] ?>" class="offer-img">
										<img src="<?= $baseURL."uploads/".$data['gambar'] ?>" class="img-responsive" alt="">
									</a>
									<div class="mid-1">
										<div class="women">
											<h6><a href="<?= $baseURL."customer/detail_products.php?id=".$data['id_barang'] ?>"><?= ucwords(strtolower($data['nama_barang'])); ?></a></h6>							
										</div>
										<div class="mid-2" style="flex-grow: 1;">
											<p ><em class="item_price">Rp. <?=number_format($data['harga'],0,0,'.') ?></em></p>
											<div class="clearfix"></div>
										</div>
										<div class="add" style="flex-grow: 3;">
										   <button class="btn btn-danger my-cart-btn my-cart-b " data-id="<?=$data['id_barang'] ?>" data-name="<?=$data['nama_barang'] ?>" data-summary="<?=$data['deskripsi'] ?>" data-price="<?=$data['harga'] ?>" data-quantity="1" data-image="<?=$baseURL."uploads/".$data['gambar'] ?>" >Add to Cart</button>
										</div>
										
									</div>
								</div>
							</div> 
							<?php  }} ?>
						 </div>
					</div>				
					
					<?php } ?>
				</div>
			</div>
               
        </div>

</div>