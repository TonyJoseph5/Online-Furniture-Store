<?php

// Include Database connection
require("../conn.php");
// Include SimpleXLSXGen library
include("SimpleXLSXGen.php");

$orders = [
  ['Sl no', 'Name', 'Address', 'Contact', 'Item', 'Quantity', 'Price','Order Date']
];

$id = 0;
$sql = "SELECT name, address, mobile, p_name, quantity, total_price, order_date FROM `tbl_orders` join tbl_users on tbl_users.login_id=tbl_orders.user_id where tbl_orders.is_delivered='NO'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
  foreach ($res as $row) {
    $id++;
    $orders = array_merge($orders, array(array($id, $row['name'], $row['address'], $row['mobile'], $row['p_name'], $row['quantity'], $row['total_price'],$row['order_date'])));
  }
}

$xlsx = SimpleXLSXGen::fromArray($orders);
$xlsx->downloadAs('orders.xlsx'); // This will download the file to your local system

// $xlsx->saveAs('orders.xlsx'); // This will save the file to your server

echo "<pre>";
print_r($orders);
