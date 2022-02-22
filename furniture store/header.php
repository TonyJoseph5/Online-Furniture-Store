<?php
error_reporting(0);
session_start();
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>furniture world</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/categories.css" rel="stylesheet">


    <!-- Add fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Add icon -->
    <link rel="shortcut icon" href="img/icon.png" />
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
 <style>
  .sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  /*top: 0;
  right: 25px;*/
  top: 0;
  font-size: 36px;
  margin-left: 80%;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
  font-size:4;
}
.fa-caret-down {
  float: right;
  padding-right: 4px;
  margin-top: 6px;
}
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 10px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  border: none;
}
.dropdown-btn {
  font-size: 20px;
}
.active {
  background-color: #262626;
  color: white;
  border: none;
  outline: none;
}
 </style>

  </head>

  <body>

    <!-- Navigation -->
    <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" style="text-decoration:none;" class="closebtn" onclick="closeNav()">&times;</a>
  <?php
      $sql = "SELECT * FROM tbl_categories where status=1";
      $result = mysqli_query($conn,$sql );
      while($row = mysqli_fetch_array( $result )){

        echo "<button style='outline: none; border: none;' class='dropdown-btn'><font size='4'>".$row['cat_name']."</font></button>";
        $sql2="SELECT * FROM tbl_subcategories WHERE cat_id = {$row['cat_id']} order by subcat_name";
        $result2 = mysqli_query($conn,$sql2 );
        if(mysqli_num_rows($result2)!=0)
        {
               echo "<div class='dropdown-container'>";
                while($row2 = mysqli_fetch_array( $result2 ))
                {
                  
                ?>
                      <a href="index.php?id=<?php echo $row2['s_id']; ?>"style="text-decoration:none;" ><?php echo "<font size='4'>".$row2["subcat_name"]."</font>";?></a>
        <?php  
                
                }
        }
  echo '</div>';
 }
  echo '</div>';
?>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top navColor ">
      <span style="font-size:20px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
      <div class="container ">
         
        <a class="navbar-brand" style="font-family:Lucida Handwriting;" href="index.php"><img src='img/icon.png' style='height:5%;width:4%;'/>Furniture <span style="Color:#F00;">World</span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="addtocart.php">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <?php 
                if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
                {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='login.php'>login</a>
                    </li>";
                }
                else
                {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='userorders.php'>My Orders</a>
                    </li>";
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='cp/logout.php'>logout</a>
                    </li>";
                }
            ?>
            
          </ul>
          
        </div>
        <!-- <i style="color:yellow;margin-left:20px;cursor: pointer;margin-top:1px;" class="fas fa-shopping-cart"></i> -->
        
      </div>
      <?php 
        if ((isset($_SESSION['user'])) && (isset($_SESSION['psw'])))
        {
          $loginid=$_SESSION['user'];
          $sql=mysqli_query($conn,"select name from tbl_users where login_id='$loginid'");
          $res=mysqli_fetch_array($sql);
          $name=$res['name'];
          $pieces = explode(" ", $name);
          $first_name = $pieces[0]; 

      ?>
        <?php echo "<font color='white'>".$first_name."</font>&nbsp;";?> <img src='img/dp.jpg' style="width:21px;height:20px;border-radius:10px;">
     <?php }
     ?>
    </nav>
    <form method=post action=index.php>
    <!-- <div class="navbar2"> -->

</form>
<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
function openNav() {
  document.getElementById("mySidenav").style.width = "220px";
  document.getElementById("mySidenav").style.marginTop = "50px";


}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";

}
</script>
</body>
</html>