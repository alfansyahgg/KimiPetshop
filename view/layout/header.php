<div class="container">
			
			<div class="logo">
				<h1 ><a href="<?= $base_url ?>"><b>K<br>I<br>M<br>I</b>&nbsp;Petshop<span>The Best Petshop</span></a></h1>
			</div>
			<div class="head-t">
				<?php if(!empty($_SESSION) && $_SESSION['is_login']){ ?>
				<ul class="card">
					<li><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i><?= $_SESSION['username'] ?></a></li>
						<?php if($_SESSION['hak_akses'] == '1'){ ?>
							<li><a href="dashboard.php"><i class="fa fa-gear" aria-hidden="true"></i>Admin Page</a></li>
						<?php }else{ ?>
							<li><a href="<?= $baseURL."customer/profil.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121') ?>"><i class="fa fa-gear" aria-hidden="true"></i>Profile Page</a></li>

							<li><a href="<?= $baseURL."customer/pesanan.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121') ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i>Pesanan Saya</a></li>


						<?php } ?>
					<li><a href="<?= $base_url ?>action/action_logout.php"><i class="fa fa-sign-out logout" aria-hidden="true"></i>Logout</a></li>
				</ul>
				<?php }else{ ?>
				<ul class="card">
					<li><a href="<?= $base_url ?>login.php" ><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
					<li><a href="<?= $base_url ?>register.php" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Register</a></li>
				</ul>
				<?php } ?>
			</div>
			
				

				<div class="nav-top">
					<nav class="navbar navbar-default">
					
					<div class="navbar-header nav_2">
						<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						

					</div> 
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav ">
							<li class=" active"><a href="<?= $baseURL ?>" class="hyper "><span>Home</span></a></li>	
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Kategori<b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<div class="col-sm-3">
											<ul class="multi-column-dropdown">
												<?php 
												$query = "select * from tbl_kategori";
												$result = mysqli_query($conn,$query);
												while($row = mysqli_fetch_assoc($result)){
												?>
												<li><a href="kitchen.html"><i class="fa fa-angle-right" aria-hidden="true"></i><?= $row['nama_kategori'] ?></a></li>
												
												<?php } ?>
											</ul>
										
										</div>

										<div class="col-sm-3"></div>
										
										<div class="col-sm-3 w3l">
											<a href="kitchen.html"><img src="<?= $base_url ?>assets_customer/images/me.png" class="img-responsive" alt=""></a>
										</div>
										<div class="clearfix"></div>
									</div>	
								</ul>
							</li>
						</ul>
					</div>
					</nav>
					 <div class="cart" >
					
						<span class="fa fa-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
					</div>
					<div class="clearfix"></div>
				</div>
					
				</div>