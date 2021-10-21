<?php 

session_start();
include('../../action/connect.php');

$base_url = 'http://localhost/kimi-petshop/';

if($id_users != $_SESSION['id_user']){
  echo "prohibited";exit();
}

$idBarang = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../view/layout/head.php'); ?>

</head>
<body>
<div class="header">
	<?php include('../../view/layout/header.php'); ?>				
</div>
  <!---->

  <div class="banner-top">
  <div class="container">
    <h3 >Lorem</h3>
    <h4><a href="index.html">Home</a><label>/</label>Lorem</h4>
    <div class="clearfix"> </div>
  </div>
</div>
    <div class="single">
      <div class="container">
        <?php
        $queryGetBarangById = "select *,g.gambar from tbl_barang b inner join tbl_gambar g on b.id_barang = g.id_barang where b.id_barang=$idBarang group by b.id_barang";
        $result = mysqli_query($conn,$queryGetBarangById);
        while($row = mysqli_fetch_array($result)){
        ?>
            <div class="single-top-main">
        <div class="col-md-5 single-top">
        <div class="single-w3agile">

          <div id="picture-frame">
      <img src="<?=$baseURL."uploads/".$row['gambar']  ?>" data-src="<?=$baseURL."uploads/".$row['gambar']  ?>" alt="" class="img-responsive"/>
    </div>
                    <script src="<?=$baseURL?>assets/assets_customer/js/jquery.zoomtoo.js"></script>
                <script>
      $(function() {
        $("#picture-frame").zoomToo({
          magnify: 1
        });
      });
    </script>
    
    
    
      </div>
      </div>
      <div class="col-md-7 single-top-left ">
        
        <div class="single-right">
        <h3><?= ucwords(strtolower($row['nama_barang'])) ?></h3>
        
          
         <div class="pr-single">
          <p class="reduced "><?= "Rp. ".number_format($row['harga'],0,0,'.')  ?></p>
        </div>
        <div class="block block-w3">
          <div class="starbox small ghosting"> </div>
        </div>
        <p class="in-pa"> <?= $row['deskripsi'] ?> </p>
          
        <ul class="social-top">
          <li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
          <li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
          <li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
          <li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
        </ul>
          <div class="add add-3">
                       <button class="btn btn-danger my-cart-btn my-cart-b " data-id="<?=$row['id_barang'] ?>" data-name="<?=$row['nama_barang'] ?>" data-summary="<?=$row['deskripsi'] ?>" data-price="<?=$row['harga'] ?>" data-quantity="1" data-image="<?=$baseURL."uploads/".$row['gambar'] ?>" >Add to Cart</button>
                    </div>
        
         
         
      <div class="clearfix"> </div>
      </div>
     

      </div>
       <div class="clearfix"> </div>
     </div> 
         
        
    <?php } ?>
  </div>
</div>

<!--content-->
<div class="content-top ">
    
</div>
<!--content-->


<!--footer-->
<div class="footer">
	<?php include('../../view/layout/footer.php'); ?>				
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
		<script src="<?=$baseURL?>assets/assets_customer/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<script type='text/javascript' src="<?=$baseURL?>assets/assets_customer/js/jquery.mycart.js"></script>
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