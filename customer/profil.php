<?php 

session_start();
include('../action/connect.php');

$base_url = 'http://localhost/olshop_petshop/';

$code = $_GET['u'];

$decryption_iv = '1234567891011121';
$decryption_key = "gg";

$id_users = openssl_decrypt($code,"AES-128-CTR","gg",0,$decryption_iv);

// echo "<pre>";print_r($username);exit();

if($id_users != $_SESSION['id_user']){
  echo "prohibited";exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../view/layout/head.php'); ?>

</head>
<body>
<div class="header">
	<?php include('../view/layout/header.php'); ?>				
</div>
  <!---->

  <div class="banner-top">
    <div class="container">
      <h3 >Kimi Petshop</h3>
      <h4><a href="index.html">Home</a><label>/</label>Lorem</h4>
      <div class="clearfix"> </div>
    </div>
  </div>

    
    <div class="single">
      <div class="container">
             <div class="col-md">
              <?php
              $query = "select * from tbl_users where id_users = $id_users ";
              $result = mysqli_query($conn,$query);
              while($row = mysqli_fetch_array($result) ){
              ?><h1>Lengkapi Data!</h1> <br><br>
                <form enctype="multipart/form-data" method="post" action="<?= $baseURL ?>action/update_profile.php">
                    <div class="form-group">
                      <label>Nama</label>
                      <input required type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= $row['nama'] ?>">
                      <input type="hidden" name="id_users" value="<?= $row['id_users'] ?>">
                    </div>

                    <div class="form-group">
                      <label>Nama Belakang</label>
                      <input required type="text" name="nama_belakang" class="form-control" placeholder="Nama Lengkap" value="<?= $row['nama_belakang'] ?>">
                    </div>

                    <div class="form-group">
                      <label>Username</label>
                      <input value="<?= $row['username'] ?>" required type="text" name="username" class="form-control" placeholder="username">
                    </div>

                    <div class="form-group">
                      <label>E-Mail</label>
                      <input required type="email" name="email" class="form-control" placeholder="E-Mail Aktif" value="<?= $row['email'] ?>">
                    </div>

                    <div class="form-group">
                      <label>Nomor Handphone</label>
                      <input requiredtype="number" name="no_hp" class="form-control" placeholder="Nomor Aktif" value="<?= $row['no_hp'] ?>">
                    </div>

                    <div class="form-group">
                      <label>Kota</label>
                      <input value="<?= $row['kota'] ?>" required type="text" name="kota" class="form-control" placeholder="kota">
                    </div>

                    <div class="form-group">
                      <label>Kode Pos</label>
                      <input value="<?= $row['kode_post'] ?>" required type="number" name="pos" class="form-control" placeholder="kode_post">
                    </div>

                    <div class="form-group">
                      <label>Username</label>
                      <input value="<?= $row['username'] ?>" required type="text" name="username" class="form-control" placeholder="username">
                    </div>

                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea required rows="5" class="form-control" name="alamat"><?= $row['alamat'] ?></textarea>
                    </div>

                    <img style="margin: 20px auto;" src="<?= $baseURL.'uploads/'.$row['gambar'] ?>" width="100" height="100">

                    <div class="form-group">
                      <label>Gambar Profil</label>
                      <input type="file" name="gambar" class="form-control-file">
                    </div>

                    <button class="btn btn-success">Update Identitas</button>
                  </form>

                  <br><br><h1>Informasi Login</h1> <br><br>
                  <form id="login" method="post" action="<?= $baseURL ?>action/update_password.php">
                    <div class="form-group">
                      <label>Password Baru</label>                      
                      <input type="hidden" name="id_users" value="<?= $row['id_users'] ?>">
                      <input required type="password" name="password" class="form-control pw" >
                    </div>
                    <div class="form-group">
                      <label>Konfirmasi Password Baru</label>
                      <input required type="password" name="password_new" class="form-control pw-confirm">
                    </div>

                    <button class="btn btn-success">Update Password</button>
                  </form>
                <?php } ?>
              </div>



      </div>
    </div>

<!--content-->
<div class="content-top ">
    
</div>
<!--content-->


<!--footer-->
<div class="footer">
	<?php include('../view/layout/footer.php'); ?>				
</div>
<!-- //footer-->

<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {

      $("form#login").on('submit',function(){
        var psw = $('.pw').val()
        var pswc = $('.pw-confirm').val()

        if(pswc != psw){
          alert('Password tidak valid!')
          return;
        }
      })

		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
<!-- for bootstrap working -->
		<script src="<?=$baseURL?>assets_customer/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<script type='text/javascript' src="<?=$baseURL?>assets_customer/js/jquery.mycart.js"></script>
  <script type="text/javascript">
  $(function () {

    $("ul.nav.tabs li").first().addClass('active')
    $("div.tab-content div.tab-pane").first().addClass('active')

    const isLogin = '<?php echo(!empty($_SESSION) && $_SESSION['is_login'] ? true : false ) ?>'

    $('.my-cart-btn').on('click',function(){
      if(!isLogin){
            window.location = "<?= $baseURL."login.php" ?>"
            localStorage.products = JSON.stringify(products);
            return;
          }
    })


    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {

		$.ajax({
			  type: 'POST',
			  url: '<?= $base_url ?>'+'action/transaction.php',
			  dataType: 'json',
			  data: {products: products},
			  success: function(res){
				  console.log(res)
			  }
		  })
        $.each(products, function(i,val){
          console.log(val);
		  
        });
      },
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      getDiscountPrice: function(products) {
        var total = 0;
        $.each(products, function(){
          total += this.quantity * this.price;
        });
        return total * 1;
      }
    });

  });
  </script>
  
</body>
</html>