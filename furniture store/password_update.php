<?php
require("conn.php");
session_start();
$sendotp= $_SESSION['check'];
$user=$_POST['user'];
$enteredotp=$_POST['enteredotp'];
$pass=$_POST['pass'];
//echo $sendotp." ".$user." ".$pass." ".$enteredotp;
if($enteredotp == $_SESSION['check'])
{
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
$q=mysqli_query($conn, "update tbl_login set `password`='$hashed_password' where username='$user'") or die(mysqli_error($conn));
			if($q)
			{
				echo "<script>alert('Password updated successfully');window.location.href='login.php';</script>";
			}
}   
else
{
	echo "<script>alert('Invalid OTP');</script>";
}
?>