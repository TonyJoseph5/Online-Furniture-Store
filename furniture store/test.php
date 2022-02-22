<?php
require("conn.php");
include("header.php");
$user='tj83362@gmail.com';
if(isset($_POST['confirm']))
{
    
        
            $pass=$_POST['pass'];
           // echo  $pass;
			$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
           // echo $hashed_password ;
           $q=mysqli_query($conn, "update tbl_login set `password`='$hashed_password' where username='$user'") or die(mysqli_error($conn));
           if($q)
			{
				echo "<script>alert('Password updated successfully');</script>";
			}
			
		
       
}
		
       
?>
<html>
    <head>
        </head>
        <body>
        <form method="POST"  class="my-login-validation" novalidate="">
        <div class="form-group">
									<label for="password">Password</label>
									<input  type="password" class="form-control"  name="pass"  required autofocus>
								</div>
                                <button type="submit" name='confirm' class="btn btn-primary btn-block">
										Confirm
									</button>
        </form>
<?php
echo"<br><br><br><br><br><br><br><br>";
include("footer.php");
?>