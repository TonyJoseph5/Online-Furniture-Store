<?php 
session_start();
require("../conn.php");
include('pdf_mc_table.php');
if(isset($_POST['generatepdf']))
{
  $result = mysqli_query($conn,"SELECT name, address, mobile, p_name, quantity, total_price, order_date FROM `tbl_orders` join tbl_users on tbl_users.login_id=tbl_orders.user_id where tbl_orders.is_delivered='YES'");
  $pdf = new PDF_MC_TABLE();
  $pdf->AddPage();

  $pdf->SetFont('Arial', 'B', 15);
  $pdf->Cell(176, 5, 'Order Details', 0, 0, 'C');
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();

  $pdf->SetFont('Arial','',10);
  
  $pdf->SetWidths(Array(11,20,25,30,20,20,20,30));

  $pdf->SetLineHeight(5);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(11,5,"Sl No",1,0);
  $pdf->Cell(20,5,"Name",1,0);
  $pdf->Cell(25,5,"Address",1,0);
  $pdf->Cell(30,5,"Contact",1,0);
  $pdf->Cell(20,5,"Item",1,0);
  $pdf->Cell(20,5,"Quantity",1,0);
  $pdf->Cell(20,5,"Price",1,0);
  $pdf->Cell(30,5,"Order_date",1,0);


  $pdf->Ln();
  
  $pdf->SetFont('Arial','',10);	
  $i=1;
  foreach($result as $row) {
    $pdf->Row(Array(
        $i,
		$row['name'],
		$row['address'],
		$row['mobile'],
		$row['p_name'],
		$row['quantity'],
		$row['total_price'],
    $row['order_date'],
	));
	$i++;
  }
  $pdf->Output();
}
?>