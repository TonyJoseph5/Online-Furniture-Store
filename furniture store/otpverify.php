<?php
session_start();
require("conn.php");
include("header.php");
$user=$_POST['user'];
if(!isset($_POST['confirm']))
{
	$user=$_POST['user'];
	$q=mysqli_query($conn,"select * from tbl_login where username='$user'");
	$count=mysqli_num_rows($q);
	if($count>0)
	{
		$otp=rand(100000,999999);
		$_SESSION['check']=$otp;
		$to      = $user;
		$subject = 'Password Reset Request for Your Account';
		$message = 'For resetting your password, you have to enter this verification code when prompted:  '.$otp;
		$headers = 'From: Furniture World <tj7250038@gmail.com>'       . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

		$result=mail($to, $subject, $message, $headers);
		if($result)
		{
			echo "<script>alert('Mail Send Successfully');</script>";
			
		}
		else
		{
			echo "<script>alert('Something went wrong...');</script>";
		}
	}
	else
	{
		echo "<script>alert('Email not found');window.location.href='forgot_password.php';</script>";
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
    <script>
        function check()
        {
            if (document.getElementById('pass').value != document.getElementById('repass').value)
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
							<h4 class="card-title">Reset Password</h4>
							<form method="POST" action="password_update.php" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">Enter OTP Recieved</label>
									<input id="email" type="number" class="form-control" name="enteredotp"  required autofocus>
									<div class="invalid-feedback">
										OTP is invalid
									</div>
								</div>
                                <div class="form-group">
									<label for="password">Password</label>
									<input id="pass" type="password" class="form-control" onkeyup="check();" name="pass"  required autofocus>
								</div>
                                <div class="form-group">
									<label for="password">Retype Password</label>
									<input id="repass" type="password" class="form-control" onkeyup="check();" name="repass" required autofocus>
                                    <span id='message'></span>
								</div>
								<div class="form-group m-0">
									<input type="hidden" name="user" value="<?php echo $user;?>">
									<button type="submit" name='confirm' class="btn btn-primary btn-block">
										Confirm
									</button>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
<?php
echo"<br><br><br><br><br><br><br><br>";
include("footer.php");
?>
