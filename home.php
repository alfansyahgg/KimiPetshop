<?php 

session_start();
include('action/connect.php');

$base_url = 'http://localhost/kimi-petshop/';

$linkpesanan = '';

if(!empty($_SESSION)){
  if($_SESSION['is_login']){
    $linkpesanan = $baseURL."view/customer/pesanan.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121');
    // echo "<pre";print_r($linkpesanan);exit();
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include('view/layout/head.php'); ?>

</head>
<body>
<div class="header">
	<?php include('view/layout/header.php'); ?>				
</div>
  <!---->
  <?php  include('view/layout/carousel.php'); ?>

    <script>window.jQuery || document.write('<script src="assets/assets_customer/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="assets/assets_customer/js/jquery.vide.min.js"></script>

<!--content-->
<div class="content-top ">
    <?php include('./view/customer/v_index.php'); ?>
</div>
<!--content-->
  <!-- Carousel
    ================================================== -->

<!--content-->
	<div class="product">
      <div class="container">
        <div class="spec ">
          <h3>Special Offers</h3>
          <div class="ser-t">
            <b></b>
            <span><i></i></span>
            <b class="line"></b>
          </div>
        </div>

        <div class="con-w3l divproduk" style="display: flex;flex-wrap: wrap;">
          <?php include('view/layout/product.php'); ?>
        </div>

        <div style="width: 100%;height: auto;" class="text-center">
          <button class="btn btn-primary btn-loadmore" style="margin: 0 auto;padding: 15px 30px;">Load More</button>
        </div>
      </div>
	</div>

  <!-- Modal Checkout-->
<div class="modal fade" id="penerimaModal" tabindex="-1" role="dialog" aria-labelledby="penerimaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penerimaModal">Informasi Penerima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Nama Penerima</label>
            <input type="text" class="form-control i-penerima" required="" name="penerima">
          </div>

          <div class="form-group">
            <label>No HP Penerima</label>
            <input type="number" class="form-control i-nohp" required name="nohp">
          </div>

          <div class="form-group">
            <label>Kota Penerima</label>
            <input type="text" class="form-control i-kota" required name="kota">
          </div>

          <div class="form-group">
            <label>Kode Pos Penerima</label>
            <input type="number" class="form-control i-pos" required name="pos">
          </div>

          <div class="form-group">
            <label>Alamat Penerima</label>
            <textarea class="form-control t-alamat" name="alamat" required rows="5"></textarea>
          </div>

          <div class="form-group">            
            <button class="btn btn-warning btn-datadiri"><i class="fa fa-files-o">&nbsp;</i>Gunakan Data Saya</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button data-id="<?= $_SESSION['id_user'] ?>" type="button" class="btn btn-success btn-penerima">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!--footer-->
<div class="footer">
	<?php include('view/layout/footer.php'); ?>				
</div>
<!-- //footer-->

<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
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
		<script src="assets/assets_customer/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<script type='text/javascript' src="assets/assets_customer/js/jquery.mycart.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {

    $("ul.nav.tabs li").first().addClass('active')
    $("div.tab-content div.tab-pane").first().addClass('active')

    const isLogin = '<?php echo(!empty($_SESSION) && $_SESSION['is_login'] ? '1' : '0' ) ?>'

    $('.m-wthree .my-cart-btn').on('click',function(){
      if(isLogin == '0'){
            window.location = "<?= $baseURL."login.php" ?>"
            localStorage.products = JSON.stringify(products);
            return;
          }
    })

    $('.btn-loadmore').on('click',function(){
      var last = $('.xxproduk:last').attr('data-id')

      $.ajax({
        type: 'GET',
        data: {l:last},
        url: '<?= $baseURL ?>action/more_produk.php',
        success: function(res){
          setTimeout(function(){
            $('.xxproduk:last').after(res)
          },500)
        }
      })
    })

    var goCheckOut  = function(products){
      $("#penerimaModal").modal('show')

      $(".btn-datadiri").on('click',function(e){
        e.preventDefault()
        var id_user = $(this).attr('data-id')
        var nama = '<?= @$_SESSION['nama'] ?>'
        var no_hp = '<?= @$_SESSION['no_hp'] ?>'
        var alamat = '<?= @preg_replace('/\s+/', ' ', $_SESSION['alamat']) ?>'
        var kota = '<?= @$_SESSION['kota'] ?>'
        var pos = '<?= @$_SESSION['kode_post'] ?>'

        $(".i-penerima").val(nama)
        $(".i-nohp").val(no_hp)
        $(".i-kota").val(kota)
        $(".i-pos").val(pos)
        $(".t-alamat").val(alamat)
        })

      $(".btn-penerima").on('click',function(e){
        e.preventDefault()
        var namaPenerima = $(".i-penerima").val()
        var hpPenerima = $(".i-nohp").val()
        var kotaPenerima = $(".i-kota").val()
        var kodeposPenerima = $(".i-pos").val()
        var alamatPenerima = $(".t-alamat").val()
        if(!namaPenerima || !hpPenerima || !alamatPenerima|| !kotaPenerima|| !kodeposPenerima){
          alert('Lengkapi Data !')
          return;
        }
        $.ajax({
            type: 'POST',
            url: '<?= $base_url ?>'+'action/transaction.php',
            dataType: 'json',
            data: {penerima:namaPenerima,nohp: hpPenerima,alamat: alamatPenerima, kota_penerima: kotaPenerima,pos_penerima: kodeposPenerima,products: products},
            success: function(res){
              if(isLogin){
              window.location = '<?= $linkpesanan ?>'
            }
              
              }
          }) 

      })

      

      
    }

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

    $('.m-wthree .my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {
        goCheckOut(products)
        
    		
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
  
  <?php include('view/layout/product_modal.php');  ?>
    <!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
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
		<!-- <script src="<?= $base_url ?>assets/assets_customer/js/bootstrap.js"></script> -->
<!-- //for bootstrap working -->
<script type='text/javascript' src="<?= $base_url ?>assets/assets_customer/js/jquery.mycart.js"></script>
  <script type="text/javascript">
  $(function () {

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

    $('.modal .my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {
        $.each(products, function(){
          console.log(this);
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