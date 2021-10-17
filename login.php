<?php 

session_start();

$base_url = 'http://localhost/olshop_petshop/';

if(!empty($_SESSION)){
  if($_SESSION['is_login']){
    if($_SESSION['hak_akses'] == '0'){
      header("Location: ".$base_url);
    }else{
      header("Location: ".$base_url."dashboard.php");
    }
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
  <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Login</h3>
		<h4><a href="index.html">Home</a><label>/</label>Login</h4>
		<div class="clearfix"> </div>
	</div>
</div>
<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Login</h3>
					<form action="<?= $base_url ?>action/action_login.php" method="post">
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" name="username" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
							<div class="clearfix"></div>
						</div>
						<input type="submit" value="Login">
					</form>
				</div>
				<div class="forg">
					<a href="<?= $baseURL ?>register.php" class="forg-left">Register</a>
				<div class="clearfix"></div>
				</div>
			</div>
	</div>

    <script>window.jQuery || document.write('<script src="<?= $base_url ?>assets_customer/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="<?= $base_url ?>assets_customer/js/jquery.vide.min.js"></script>

<!--content-->
<!-- <div class="content-top ">

</div> -->
<!--content-->
  <!-- Carousel
    ================================================== -->

<!--content-->
	<!-- <div class="product">

	</div> -->
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
		<script src="<?= $base_url ?>assets_customer/js/bootstrap.js"></script>
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

    $('.m-wthree .my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {
		// console.log(products);
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