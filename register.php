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
					<h3>Register</h3>
					<form id="register" action="<?= $base_url ?>action/action_register.php" method="post">
						<label>Username</label>
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" name="username" required="">
							<div class="clearfix"></div>
						</div>

						<label>Nama Depan</label>
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" name="depan" required="">
							<div class="clearfix"></div>
						</div>

						<label>Nama Belakang</label>
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" name="belakang" >
							<div class="clearfix"></div>
						</div>

						<label>Password</label>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input type="password" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
							<div class="clearfix"></div>
						</div>

						<label>Confirm</label>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" value="Password" name="confirm" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Confirm';}" required="">
							<div class="clearfix"></div>
						</div>


						<input type="submit" value="Register"/>
					</form>
				</div>
				<div class="forg">
				<div class="clearfix"></div>
				</div>
			</div>
	</div>

    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

    <script type="text/javascript">
		$(document).ready(function(){

			
			$("form#register").on('submit',function(e){
				e.preventDefault()

				var psw = $("input[name='password']").val()
				var confirm = $("input[name='confirm']").val()

				if(psw != confirm){
					alert("Password doesn't match")
					var confirm = $("input[name='confirm']").val('')
					return;
				}

				$(this)[0].submit()

			})
		})
	</script>

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



</body>
</html>