<?php
session_start();
?>
<?php

if(isset($_SESSION["login"])){
	header ("Location: Dashboard.php");
}

 include '../configs/koneksi.php';

if (isset($_POST["submit"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query ($conn, "SELECT * FROM user WHERE username = '$username'");
	
 	
// cek username
	if (mysqli_num_rows($result) === 1) {

		// cek password

		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"]) ){
			$_SESSION["login"] = true;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['nama'] = $row['nama'];

				echo "
		<script>
		alert ('selamat datang $username')
		document.location.href ='dashboard.php';
		</script>";
			exit;
		}
	}

	$error = true;

	
}
?>

<html lang="en">


<!-- Mirrored from ableproadmin.com/bootstrap/default/auth-signin-img-side.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Nov 2021 19:01:19 GMT -->
<head>

	<title>Barokah Utama Farm</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="../assets/css/style.css">
	
	


</head>

<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
	<div class="flex-grow-1">
		<div class="h-100 d-md-flex align-items-center auth-side-img">
			<div class="col-sm-10 auth-content w-auto">
				<img src="assets/images/auth/img-auth-big.png" alt="" class="img-fluid">
				<h1 class="text-white my-4">Selamat Datang!</h1>
				<h4 class="text-white font-weight-normal">Silahkan masukkan akun anda untuk masuk ke dalam Websites.<br/>Terima kasih telah menggunakan jasa kami</h4>
			</div>
		</div>
		<div class="auth-side-form">
			<div class=" auth-content">
				<img src="assets/images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
				<form action="" method="POST">
				<h3 class="mb-4 f-w-400">Hello !</h3>
				<div class="form-group mb-3">
					<label class="floating-label">Username</label>
					<input type="text" class="form-control" name="username" autocomplete="off" >
				</div>
				<div class="form-group mb-4">
					<label class="floating-label" for="Password">Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				
				<button type="submit" class="btn btn-block btn-primary mb-4" name="submit">Masuk</button>
				<div class="text-center">
					</form>
					<!-- <div class="saprator my-4"><span>OR</span></div>
					<button class="btn text-white bg-facebook mb-2 mr-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-facebook-f"></i></button>
					<button class="btn text-white bg-googleplus mb-2 mr-2 wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-google-plus-g"></i></button>
					<button class="btn text-white bg-twitter mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-twitter"></i></button>
					<p class="mb-2 mt-4 text-muted">Forgot password? <a href="auth-reset-password-img-side.html" class="f-w-400">Reset</a></p> -->
					<!-- <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup-img-side.html" class="f-w-400">Signup</a></p> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ signin-img ] end -->

<!-- Required Js -->
<script src="../assets/js/vendor-all.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/ripple.js"></script>
<script src="../assets/js/pcoded.min.js"></script>



</body>


<!-- Mirrored from ableproadmin.com/bootstrap/default/auth-signin-img-side.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Nov 2021 19:01:19 GMT -->
</html>
