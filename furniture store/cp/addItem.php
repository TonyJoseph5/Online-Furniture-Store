<?php 
session_start();
require("../conn.php");
include("header2.php");
//------------------
if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
{
    header('location:../index.php');
}
else{
  $sql="select * from tbl_products";
  $query1=mysqli_query($conn,$sql);
}
if(isset($_POST['submit']))
{
//---------------
$sid=$_POST['sid'];
$name=$_POST['fname'];
$description=$_POST['fdescription'];
$price=$_POST['fprice'];
$quantity=$_POST['quantity'];
$dealer=$_POST['dealer'];
$adate=date("Y-m-d");
//--------------- 
  
$filepath=pathinfo($_FILES['file']['name']) ;
$extension=$filepath['extension'];
  
$iname= date('H-i-s').'.'.$extension;
$path='../img/'.$iname;
move_uploaded_file($_FILES['file']['tmp_name'],$path);

  
//---------------
  
$sqlInsert ="INSERT INTO tbl_products(`s_id`,`p_name` , `p_description` , `p_price` ,`p_quantity`,`dealer`,`add_date`, `p_img`,`p_status`) VALUES ('$sid', '$name', '$description' , '$price' ,'$quantity','$dealer','$adate', '$iname','1')";  
  
  
$queryInsert=mysqli_query($conn,$sqlInsert) or die(mysqli_error($conn));
if($queryInsert)
    echo "<script type='text/javascript'>alert('data inserted successfully');</script>";  

echo"<script>window.location.href='addItem.php';</script>";
}
if(isset($_POST['delete']))
{
  var_dump($_POST['id']);
  $sql="delete from tbl_products where p_id=".$_POST['id'];
  $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
  echo "<script>alert('Deleted Successfully');</script>";
  echo "<script>window.location.href='addItem.php';</script>";
}

?>
<html>
  <head>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">     
    $(document).ready(function() {
    $('#example').DataTable();
    } );
	function check()
	{
		if (document.getElementById('quantity').value>100)
		{
			document.getElementById('message').style.color = 'red';
			document.getElementById('message').innerHTML = 'please enter a valid quantity';
		}
		else
		{
			document.getElementById('message').style.color = '';
			document.getElementById('message').innerHTML = '';

		}
	}
  var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
  function ValidateSingleInput(oInput) {
      if (oInput.type == "file") {
          var sFileName = oInput.value;
          if (sFileName.length > 0) {
              var blnValid = false;
              for (var j = 0; j < _validFileExtensions.length; j++) {
                  var sCurExtension = _validFileExtensions[j];
                  if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                      blnValid = true;
                      break;
                  }
              }
              
              if (!blnValid) {
                  alert("Sorry, file is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                  oInput.value = "";
                  return false;
              }
          }
      }
      return true;
  }
    </script>
    </head>
    <body>
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Add 
        <small>item</small>
      </h1>

      <!-- start div form  -->
      <div class="row">
        

              <div class="col-lg-6 col-md-6">
	<!-- ------- start  form -------- -->

             <form  method="post" enctype="multipart/form-data">
 
                <!-- Name  -->
                  <div class="form-group">
                    <label for="Nameitem">Name</label>
                    <input name="fname" type="text" required="required" class="form-control" id="Nameitem"  placeholder="chair">
                  </div>
                  

                <!-- Description  -->
                <div class="form-group">
                    <label for="Descriptionitem">Description</label>
                    <input name="fdescription" type="text" required="required" class="form-control" id="Descriptionitem" placeholder="Say something about product">
                  </div>

                  <!-- price  -->
                <div class="form-group">
                    <label for="priceitem">Price</label>
                    <input name="fprice" type="text" required="required" class="form-control" id="priceitem"  placeholder=" 98.9">
                  </div>
                  <div class="form-group">
                    <label for="priceitem">Quantity</label>
                    <input name="quantity" type="number" required="required" class="form-control" onkeyup="check();" id="quantity"  placeholder="100">
                  </div>
                  <span id='message'></span>
              </div>
              

              <div class="col-lg-6 col-md-6">

                  <!-- Category  -->
                  <div class="form-group">
                      <label class="pt-2 pb-4 text-center" for="categories">Choose  category</label>
                            <select class="form-control" id="categories" name="sid" required>
                                <option value="">select</option>
                                <?php 
                                  $sql="select * from tbl_subcategories";
                                  $query=mysqli_query($conn,$sql);
                                  while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){ ?>
                                     <option value="<?php echo $row['s_id'];?>"><?php echo ($row['subcat_name']); ?></option>
                             <?php }
                              ?>
                             </select>
                    </div>
                    <div class="form-group">
                      <label class="pt-2 pb-4 text-center" for="categories">Dealer Information</label>
                      <input name="dealer" type="text" required="required" class="form-control" id="Nameitem"  placeholder="Dealer Info">
                  </div>
                  <!-- File  -->
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Image</label>
                        <input type="file" class="form-control-file" onchange="ValidateSingleInput(this);" id="exampleFormControlFile1" name="file">
                      </div>
                      
                  <!-- Submit -->
                    <button type="submit" name='submit' class="btn btn-success ">Add New </button>

                  </form>
              </div>
      </div>
     <!-- end div form  -->


      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12" style="margin-top: 50px; margin-bottom: 50px;">
          
            <h2>All items</h2>

            <!--Start table -->
            <table id="example" class="table table-striped table-bordered" style="width:100%"  >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Add Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Dealer Information</th>
					          <th scope="col">Image</th>
					          <th scope="col">Drop</th>
                  </tr>
                </thead>
                <tbody>
                
<?php  
	while($result=mysqli_fetch_array($query1))
  { 
    echo'<tr><form  method="post">';
    echo "<td>".$result['p_id']."</td>";
    echo "<td>".$result['p_name']."</td>";
    echo "<td>".$result['p_description']."</td>";
    echo "<td>".$result['add_date']."</td>";
    echo "<td style='color:red;'>&#8377;&nbsp;".$result['p_price'] ."</td>";
    echo "<td>".$result['dealer']."</td>";
    echo "<td><img src='../img/".$result['p_img']."' height='55px' width='100px'></td>";
    echo "<td><input type='hidden' name='id' value=".$result['p_id']."><input type='submit' name='delete' value='Delete' class='btn btn-danger btn-sm'></td></tr></form>";
    //echo"<td><a href=deleteitem.php?id='".$result['p_id']."'><button>Delete</button</a>";

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
</form>
</body>

<?php
include("../footer.php")
?>
