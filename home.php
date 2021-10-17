<?php 

session_start();
include('action/connect.php');

$base_url = 'http://localhost/olshop_petshop/';

$linkpesanan = '';

if(!empty($_SESSION)){
  if($_SESSION['is_login']){
    $linkpesanan = $baseURL."customer/pesanan.php?u=".openssl_encrypt($_SESSION['id_user'], "AES-128-CTR", "gg",0,'1234567891011121');
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

    <script>window.jQuery || document.write('<script src="assets_customer/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="assets_customer/js/jquery.vide.min.js"></script>

<!--content-->
<div class="content-top ">
    <?php include('./customer/v_index.php'); ?>
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
		<script src="assets_customer/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<script type='text/javascript' src="assets_customer/js/jquery.mycart.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {

    $("ul.nav.tabs li").first().addClass('active')
    $("div.tab-content div.tab-pane").first().addClass('active')

    const isLogin = '<?php echo(!empty($_SESSION) && $_SESSION['is_login'] ? true : false ) ?>'

    $('.m-wthree .my-cart-btn').on('click',function(){
      if(!isLogin){
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

    		$.ajax({
    			  type: 'POST',
    			  url: '<?= $base_url ?>'+'action/transaction.php',
    			  dataType: 'json',
    			  data: {products: products},
    			  success: function(res){
              if(isLogin){
              window.location = '<?= $linkpesanan ?>'
            }
    				  
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
		<!-- <script src="<?= $base_url ?>assets_customer/js/bootstrap.js"></script> -->
<!-- //for bootstrap working -->
<script type='text/javascript' src="<?= $base_url ?>assets_customer/js/jquery.mycart.js"></script>
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