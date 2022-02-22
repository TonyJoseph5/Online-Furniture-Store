<?php 
require("conn.php");
include("header.php");

if(isset($_REQUEST['id'])){
  $sid=$_REQUEST['id'];
  //$sql="select * from tbl_products  JOIN tbl_categories ON tbl_products.cat_id = tbl_categories.cat_id where s_id='$sid'";
  $sql="select * from tbl_products  where s_id='$sid'";

  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
}else{
  $sql="select * from tbl_products LEFT  JOIN tbl_subcategories ON tbl_products.s_id = tbl_subcategories.s_id ";
  $query=mysqli_query($conn,$sql);
}
?>
<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="body">
    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One -->
          <div class="carousel-item active" style="background-image: url('img/bg1.jpeg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Homely Indulgence </h3>
              <p>where we combine the quality of name brand furniture with the pricing of discount warehouse shopping.</p>
            </div>
          </div>
          <!-- Slide Two -->
          <div class="carousel-item" style="background-image: url('img/bg2.jpeg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Best Sellers</h3>
              <p>This is a best website by Furniture online.</p>
            </div>
          </div>
          <!-- Slide Three -->
          <div class="carousel-item" style="background-image: url('img/bg3.jpeg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Save Money</h3>
              <p>we have the best discount.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <!-- Prduct -->
      <h1 class="my-4">Welcome to Furniture World.</h1>
      
      <!-- start Product Item -->
      <div class="row">
        <!-- iteam 1-->
		 
<?php  
	while($result=mysqli_fetch_array($query))
	{
	?>
	<div class='col-lg-4 col-sm-6 portfolio-item'>
          <a href='#'><div class='card h-80'> <img width='700' height='200' class='card-img-top' src='img/<?php echo $result['p_img'];?>' alt=''></a>
            <div class='card-body'>
              <h5 class='card-title'>
                <a href='#'><?php echo $result['p_name'];?></a>
              </h5>
              <p class='card-text' >Description : <span class='card-Category'><?php echo $result['p_description'];?></span> </p>
              <p class='card-text'>Price : <span class='card-price'>&#8377;&nbsp;<?php echo $result['p_price'];?></span> </p>
              <?php if($result['p_quantity']<5)
              {
              ?>
              <p style="color:red;">Out of Stock</p>
              <?php
              }
              ?>
              <p><form method='post' action='addtocart.php' ><input type='hidden'  name='pid' value="<?php echo $result['p_id'];?>"><button type='submit'  class='btn btn-primary btn-sm'>Add to Cart</button>&emsp;<button type='submit' class='btn btn-primary btn-sm'>Buy Now</button></form></p>
			</div>
          </div>
        </div>
  <?php
	}
 ?>
 </form>
        </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
</body>
</html>
<?php
include("footer.php");
?>
