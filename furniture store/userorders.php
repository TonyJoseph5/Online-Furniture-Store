<?php
session_start();
require("conn.php");
include("header.php");
if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
{
    echo "<script>alert('Please login');window.location.href='index.php'</script>";
}
$userid=$_SESSION['user'];
$sql=mysqli_query($conn,"select * from tbl_orders where user_id='$userid'");
$grandtotal=0;  
?>
<html>
<head>
</head>
<body>
<div class="row justify-content-center">
<div class="col-auto">
<table class="table table-bordered table-sm" style="margin-top:10%;" >
    <tr>
        <th  scope="col"></th>
        <th  scope="col">Item</th>
        <th  scope="col">Quantity</th>
        <th  scope="col">Unit price</th>
        <th  scope="col">Total</th>
    </tr>
    <tr></tr>
    <tbody>
        <?php while($row=mysqli_fetch_array($sql))
            {
        ?>
            <tr>
                <td><img src='img/<?php echo $row['p_img']; ?>' height='95px' width='150px'></td>
                <td><?php echo $row['p_name'];?></td>
                <td><?php echo $row['quantity'];?></td>
                <td><?php echo $row['p_price'];?></td>
                <td><?php echo $row['total_price'];?></td>
            </tr>

        <?php
        $grandtotal += ($row["p_price"]*$row["quantity"]);
            }
        ?>
        <tr>
        <td colspan="5" align="right">
        <strong>GRAND TOTAL: <?php echo "&#8377;".$grandtotal; ?></strong>
        </td>
        </tr>
        <tr>
        <td colspan="5" align="right"><a style="text-decoration:none;" href=payonline.php>Pay Now</a></td>
        </tr>
    </tbody>
</table>
</div>
</div>
</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</html>
<?php
include("footer.php");
?>
