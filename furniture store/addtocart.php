<?php
session_start();
require("conn.php");
include("header.php");
if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
{
    echo "<script>alert('Please login to add items to cart');window.location.href='index.php'</script>";
}
$userid=$_SESSION['user'];
if(isset($_POST['pid']))
{
  $pid=$_REQUEST['pid'];
  $sq=mysqli_query($conn,"select p_quantity from tbl_products where p_id='$pid'");
  $rs=mysqli_fetch_array($sq);
  if($rs['p_quantity']<5)
  {
    echo "<script>alert('Currently out of stock');window.location.href='index.php'</script>";
    exit;
  }
  $chkq=mysqli_query($conn,"select * from tbl_cart where p_id='$pid' and user_id='$userid'") or die(mysqli_error($conn));
  $count=mysqli_num_rows($chkq);
  if($count==0)
  {
    $sql=mysqli_query($conn, "select * from tbl_products where p_id='$pid'") or die(mysqli_error($conn));
    $result=mysqli_fetch_array($sql);
    $img=$result['p_img'];
    $pname=$result['p_name'];
    $pprice=$result['p_price'];
    $total=$result['p_price'];
    mysqli_query($conn,"INSERT INTO `tbl_cart` ( `user_id`, `p_id`, `p_img`, `p_name`, `p_price`, `quantity`, `total_price`) VALUES ('$userid', '$pid', '$img', '$pname', '$pprice', 1, '$total');") or die(mysqli_error($conn));
  }
  else
  {
    echo "<script>alert('Item already added');</script>";
  }
}
if(isset($_POST['quantitychange']))
{
  $qty=$_POST['quantitychange'];
  $cartid=$_POST['cartid'];
  $q=mysqli_query($conn,"select * from tbl_cart where user_id='$userid' and cart_id='$cartid'");
  $r2=mysqli_fetch_array($q);
  $total=$qty*$r2['p_price'];
  mysqli_query($conn,"update  tbl_cart set quantity='$qty', total_price='$total' where cart_id='$cartid'") or die(mysqli_error($conn));

}
if(isset($_POST['removeitem']))
{
  $cartid=$_POST['cartid'];
  $q=mysqli_query($conn,"DELETE FROM `tbl_cart` WHERE `tbl_cart`.`cart_id` = '$cartid'") or die(mysqli_error($conn));
  if($q)
  {
    echo "<script>alert('Item removed from cart');window.location.href='addtocart.php';</script>";
  }
}
if(isset($_POST['placeorder']))
{
  $r=mysqli_query($conn,"select quantity,p_id from tbl_cart where user_id='$userid'");
  while($qt =mysqli_fetch_array($r))
  {
    echo $quan=$qt['quantity'];
    echo  $pid=$qt['p_id'];
    mysqli_query($conn,"update tbl_products set p_quantity=p_quantity-$quan where p_id=$pid") or die(mysqli_error($conn));
  }
  
  $date=date("Y-m-d");
  $order=mysqli_query($conn,"INSERT INTO tbl_orders( `user_id`, `p_id`, `p_img`, `p_name`, `p_price`, `quantity`, `total_price`, `order_date`, `is_delivered` ) 
  SELECT `user_id`, `p_id`, `p_img`, `p_name`, `p_price`, `quantity`, `total_price`,'$date','NO'
  FROM tbl_cart where user_id='$userid'
  ORDER BY cart_id ASC ") or die(mysqli_error($conn));
  mysqli_query($conn,"DELETE FROM `tbl_cart` WHERE `tbl_cart`.`user_id` = '$userid'") or die(mysqli_error($conn));
  if($order)
  {
    echo "<script>alert('Order placed successfully');window.location.href='userorders.php';</script>";
  }
}
?>
<html>
  <head>
    <style>
    .removebtn{
            border:none;
            cursor:pointer;
          }
    </style>    
</head>
<body>
<br><br><br><br><br><br>
<div class="row justify-content-center">
<div class="col-auto">
<table class="table table-bordered ">
  <thead>
    <tr>
      <th  scope="col"></th>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Total Price</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
      $grandtotal=0;  
      $sql=mysqli_query($conn, "select * from tbl_cart where user_id='$userid'");
      while($result=mysqli_fetch_array($sql))
      {
      ?><form method='post'>
        <tr>
        <td><img src='img/<?php echo $result['p_img']; ?>' height='95px' width='150px'></td>
        <td class='align-middle'><?php echo $result['p_name'] ?></td>
        <td class='align-middle'>
          <input type='hidden' name='cartid' value='<?php echo $result['cart_id']; ?>' />
          <select name='quantitychange'  onchange="this.form.submit()">
          <option <?php if($result["quantity"]==1) echo "selected";?> value="1">1</option>
          <option <?php if($result["quantity"]==2) echo "selected";?> value="2">2</option>
          <option <?php if($result["quantity"]==3) echo "selected";?> value="3">3</option>
          <option <?php if($result["quantity"]==4) echo "selected";?> value="4">4</option>
          <option <?php if($result["quantity"]==5) echo "selected";?> value="5">5</option>
          </select>
        </td>
        <td class='align-middle'><?php echo $result['p_price']; ?></td>
        <td class='align-middle'><?php echo "&#8377;".$result["p_price"]*$result["quantity"]; ?></td>
        <td  class='align-middle'><input type='hidden' name='cartid' value="<?php echo $result['cart_id'];?>" ><button type='submit' name="removeitem" class="removebtn"><img src="img/icon-delete.png" alt="Remove Item" /></button></td>
        </tr>
        </form>
    <?php
    $grandtotal += ($result["p_price"]*$result["quantity"]);
    }
    ?>
       <tr>
        <td colspan="6" align="right">
        <strong>GRAND TOTAL: <?php echo "&#8377;".$grandtotal; ?></strong>
        </td>
        </tr>

</tbody>
</table>
<a href="index.php"><button  class="btn btn-primary">Continue Shopping</button></a><form method="post"><button type='submit'  name='placeorder' class="btn btn-warning  pull-right" >Order Now</button></form>
</div>
</div>
</body>
<br><br><br><br><br><br><br><br><br><br><br>
</html>
<?php
include("footer.php");
?>