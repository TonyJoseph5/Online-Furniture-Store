<?php
require("../conn.php");

var_dump($_POST['id']);

$sql="delete from tbl_categories where cat_id=".$_POST['id'];
$query=mysqli_query($conn,$sql);
echo "<script>alert('Deleted Successfully');window.location.href='addCategory.php';</script>"
// header("location:addCategory.php");
?>