<?php
error_reporting(0);
session_start();
require("conn.php");
include("header.php");

if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$chk=mysqli_query($conn,"select * from tbl_login,tbl_users where tbl_login.username='$email' or tbl_users.mobile='$mobile'") or die(mysqli_error($conn));
	$count=mysqli_num_rows($chk);
	if($count>0)
	{
    
    echo '<script>
    alert("Email or mobile already exists...");
    </script>';
   
  	}
  	else
  	{
		$name=$_POST['name'];
		$address=$_POST['address'];
		$pin=$_POST['pin'];
		$password=$_POST['password'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		mysqli_query($conn,"insert into tbl_login(username,password,type,status) values('$email','$hashed_password','user',1)");
		$last_id=mysqli_insert_id($conn);
		mysqli_query($conn,"insert into tbl_users(`login_id`,`name`,`email`,`mobile`,`address`,`pincode`) values($last_id,'$name','$email','$mobile','$address','$pin')") or die(mysqli_error($conn));
		header("location:login.php");
		echo "<script type='text/javascript'>window.location.href='login.php';alert('Registered Successfully');</script>";
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<script>
	function check()
	{
		if (document.getElementById('password').value != document.getElementById('cpassword').value)
		{
			document.getElementById('message').style.color = 'red';
			document.getElementById('message').innerHTML = 'not matching';
		}
		else
		{
			document.getElementById('message').style.color = '';
			document.getElementById('message').innerHTML = '';

		}
	}
</script>
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" name=myForm novalidate="" >
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
									<div class="invalid-feedback">
										What's your name?
									</div>
								</div>

								<div class="form-group">
									<label for="mobile">Mobile No</label>
									<input id="name" type="text" class="form-control" name="mobile" pattern= "^[6-9]\d{9}$" required autofocus>
									<div class="invalid-feedback">
										Enter a valid phone number
									</div>
								</div>

								<div class="form-group">
									<label for="address">Address</label>
									<input id="name" type="text" class="form-control" name="address" required autofocus>
									<div class="invalid-feedback">
										What's your Address?
									</div>
								</div>

								<div class="form-group">
									<label for="pincode">Pincode</label>
									<input id="name" type="number" class="form-control" name="pin" required autofocus>
									<div class="invalid-feedback">
										What's your pincode?
									</div>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" onkeyup="check();" required >
									<!--<i class="bi bi-eye-slash" id="togglePassword"></i>-->
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									<label for="Confirm-password">Confirm Password</label>
									<input id="cpassword" type="password" class="form-control" name="cpassword" onkeyup="check();" required >
									<!--<i class="bi bi-eye-slash" id="ctogglePassword"></i>-->
									<span id='message'></span>
									<div class="invalid-feedback">

										Confirm your Password
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input"  required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="terms.html">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name='submit' class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="login.php">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
<?php
include("footer.php");
?>
