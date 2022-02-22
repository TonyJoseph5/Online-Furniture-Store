<?php
require("../conn.php");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Control Panel </title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">

    <!-- Add fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Add icon -->
    <link rel="shortcut icon" href="../img/icon.png"/>
    <style>
        #Blink {
            animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
        }

        @keyframes blinker {  
          from { opacity: 1; }
          to { opacity: 0; }
        }
        .sidenav {
				  -moz-box-shadow:    -3px 0 5px 0 #555;
          -webkit-box-shadow: -3px 0 5px 0 #555;
          box-shadow:         -3px 0 5px 0 #555;
			    height: 100%; /* 100% Full-height */
			    width: 0; /* 0 width - change this with JavaScript */
			    position: fixed; /* Stay in place */
			    z-index: 1; /* Stay on top */
			    top: 0;
			    background-color: #111; /* Black*/
			    overflow-x: hidden; /* Disable horizontal scroll */
			    padding-top: 60px; /* Place content 60px from the top */
			    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
          margin-top:3.7%;
			}

			/* The navigation menu links */
			.sidenav a {
			    padding: 8px 8px 8px 32px;
			    text-decoration: none;
			    font-size: 25px;
			    color: #818181;
			    display: block;
			    transition: 0.3s
			}

			/* When you mouse over the navigation links, change their color */
			.sidenav a:hover, .offcanvas a:focus{
			    color: #f1f1f1;
			}

			/* Position and style the close button (top right corner) */
			.sidenav .closebtn {
			    position: absolute;
			    top: 0;
			    right: 25px;
			    font-size: 36px;
			    margin-left: 50px;
			}

			/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
			#main {
			    transition: margin-left .5s;
			    padding: 20px;
			}
			.sidenav {
			    right: 0;
			}
			/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
			@media screen and (max-height: 450px) {
			    .sidenav {padding-top: 15px;}
			    .sidenav a {font-size: 18px;}
			}
			.sidenav {
			    right: 0;
			}
      .dropdown {
      position: relative;
      display: inline-block;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 150px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      padding: 10px 14px;
      z-index: 1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
    </style>
  <script type="text/javascript">

    /* Simple appearence with animation AN-1*/
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    /* Simple appearence with animation AN-1*/
  </script>
  </head>

  <body>

<!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top navColor ">
      <div class="container ">
        <a class="navbar-brand" style="font-family:Lucida Handwriting;" href="index.php"><img src='../img/icon.png' style='height:5%;width:4%;'/>Furniture <span style="Color:#F00;">World</span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <div class="dropdown">
            <span class="nav-link">Orders</span>
            <div class="dropdown-content">
            <p><a href="orders.php" style="text-decoration:none;color:black;">Pending orders</a></p>
            <p><a href="orderhistory.php"style="text-decoration:none;color:black;">Order history</a></p>
            </div>
          </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addCategory.php">Add Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addItem.php">Add items</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">logOut</a>
            </li>
          </ul>
        </div>
      </div>
      <?php
      $query=mysqli_query($conn, "select * from tbl_products where p_quantity<5") or die(mysqli_error($conn));
      $count=mysqli_num_rows($query);
      // while($result=mysqli_fetch_array($query)))
      if($count!=0)
      {
        echo '<span onclick="openNav()"><font size=4><i style="color:yellow;margin-right:50px;cursor:pointer;" id="Blink" class="fa fa-exclamation-triangle" aria-hidden="true"></i></font></span>';
        echo '<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
      while($result=mysqli_fetch_array($query))
      {?>
         <a href=product_update.php?id="<?php echo $result['p_id'] ?>"><?php echo "<font size=3>".$result['p_name']."(Only ".$result['p_quantity']." left)</font>" ?></a>
      <?php 
      }
		
		  echo "</div>";
      }
     ?>
    </nav>
    
    

<!-- end Navigation -->

