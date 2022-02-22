<?php 
session_start();
require("../conn.php");
include("header2.php");
if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
{
    header('location:../index.php');
}
else{
    $query1=mysqli_query($conn,"SELECT * FROM `tbl_orders` join tbl_users on tbl_users.login_id=tbl_orders.user_id where tbl_orders.is_delivered='NO'") or die(mysqli_error($conn));
  }
if(isset($_POST['remove']))
{
  $orderid=$_POST['id'];
  mysqli_query($conn,"update tbl_orders set is_delivered='YES' where order_id='$orderid'");
  echo "<script>alert('Moved to order history');window.location.href='orders.php'</script>";
 
}
?>
<html>
  <head>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">     
    $(document).ready(function() {
    $('#example').DataTable();
    } );
    </script>
    </head>
    <body>
    <div class="container">
    <div class="row">
        <div class="col-lg-12" style="margin-top: 50px; margin-bottom: 50px;">
        <table><tr><td><form action="exportexcel2.php" method=post><button type="submit"  name="dataExport" value="Export to excel" class="btn btn-success">Export To Excel</button></form></td><td></td><td></td><td></td><td></td><td></td><td><form action="exportpdf.php" method=post><button type="submit"  name="generatepdf" value="Export as pdf" class="btn btn-danger">Export as pdf</button></form></td></tr></table>
        <br>
        <table id="example" class="table table-striped table-bordered" style="width:100%"  >
                <thead>
                  <tr>
                    <th scope="col">Sl no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Item</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Order_date</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                
<?php  
  $i=1;
	while($result=mysqli_fetch_array($query1))
  { 
    echo'<tr><form  method="post">';
    echo "<td>".$i."</td>";
    echo "<td>".$result['name']."</td>";
    echo "<td>".$result['address']."</td>";
    echo "<td>".$result['mobile']."</td>";
    echo "<td>".$result['p_name']."</td>";
    echo "<td>".$result['quantity']."</td>";
    echo "<td style='color:red;'>&#8377;&nbsp;".$result['total_price'] ."</td>";
    echo "<td>".$result['order_date']."</td>";
    echo "<td><img src='../img/".$result['p_img']."' height='55px' width='100px'></td>";
    echo "<td><input type='hidden' name='id' value=".$result['order_id']."><input type='submit' name='remove' value='Remove' class='btn btn-danger btn-sm'></td></tr></form>";

    $i++;
  }
 ?> 
            </tbody>  
            </table>
            <!--end table -->

        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
</body>
<br><br><br><br><br><br><br><br>
<?php
include("../footer.php")
?>

