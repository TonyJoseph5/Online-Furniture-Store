<?php 
session_start();
require("../conn.php");
include("header2.php");
//------------------
$sql2="select cat_id,cat_name from tbl_categories";
$query2=mysqli_query($conn,$sql2); 
if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
{
    //header('location:../index.php');
    echo "<script>window.location.href='../index.php'</script>";
}

	if(isset($_POST['addcategory']))
	{
	  $category=$_POST['category'];
    if(empty($_POST['category'])){
      echo "<script type='text/javascript'>alert('Please enter category name');window.location.href='addCategory.php';</script>";
    }
    else
    {
      $chk=mysqli_query($conn,"select * from tbl_categories where cat_name='$category'") or die(mysqli_error($conn));
      $count=mysqli_num_rows($chk);
      if($count>0)
      {
      echo "<script type='text/javascript'>alert('Entered category already exists');</script>";
      }
      else
      {
      $sql="INSERT INTO tbl_categories (cat_name,status) VALUES ('$category',1)";
      $query=mysqli_query($conn,$sql);
      if($query)
        echo "<script type='text/javascript'>alert('Data inserted successfully');window.location.href='addCategory.php';</script>";
      }
    }
	}
	if(isset($_POST['addsubcategory']))
	{
    if(empty($_POST['subcategory']) || empty($_POST['catid']))
    {
      echo "<script type='text/javascript'>alert('Please enter subcategory details');window.location.href='addCategory.php';</script>";
    }
    else
    {
      $catid=$_POST['catid'];
      $subcategory=$_POST['subcategory'];
      $chk2=mysqli_query($conn,"select * from tbl_subcategories where subcat_name='$subcategory'");
      $count2=mysqli_num_rows($chk2);
      if($count2>0)
      {
      echo "<script type='text/javascript'>alert('Entered subcategory already exists');</script>";
      }
      else
      {
      $sql="INSERT INTO tbl_subcategories(cat_id,subcat_name,status) VALUES ($catid,'$subcategory',1)";
      $query=mysqli_query($conn,$sql);
      if($query)
        echo "<script type='text/javascript'>alert('data inserted successfully');window.location.href='addCategory.php';</script>";
      }
    }
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
    </script>
    </head>
    <body>
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Add 
        <small>Categories</small>
      </h1>

      <!-- start div form  -->
      <div class="row">
        

              <div class="col-lg-6 col-md-6">
	<!-- ------- start  form -------- -->

             <form  method="post" enctype="multipart/form-data">
 
                <!-- Name  -->
                  <div class="form-group">
                    <label for="Nameitem">Enter a category</label>
                    <input name="category" placeholder="Enter a category" type="text" class="form-control" id="Nameitem"  >
                  </div>
				  <button type="submit" name='addcategory' class="btn btn-success ">Add New Category </button>


                
    
              </div>
              

              <div class="col-lg-6 col-md-6">

                  <!-- Category  -->
                  <div class="form-group">
                      <label class="pt-2 pb-4 text-center" for="categories">Enter parent category</label>
                            <select class="form-control" id="categories" name="catid" >
                                <option value="">select</option>
								<?php 
                                  $sql="select cat_id,cat_name from tbl_categories";
                                  $query=mysqli_query($conn,$sql);
                                  while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){ ?>
                                     <option value="<?php echo $row['cat_id'];?>"><?php echo ($row['cat_name']); ?></option>
                             <?php } ?>
                             </select>
                    </div>
                    <div class="form-group">
                      <label class="pt-2 pb-4 text-center" for="categories">Enter a sub category</label>
                      <input  type="text"  class="form-control" name="subcategory" placeholder="Enter a sub category" >
                  </div>
    
                      
                  <!-- Submit -->
                    <button type="submit" name='addsubcategory' class="btn btn-success ">Add New Subcategory </button>

                  </form>
              </div>
      </div>
     <!-- end div form  -->


      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12" style="margin-top: 50px; margin-bottom: 50px;">
          
            <h2>All Categories</h2>

            <!--Start table -->
            <table id="example" class="table table-striped table-bordered" style="width:100%"  >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
					<th scope="col">Details</th>
                    <th scope="col">Delete</th>
                    <!-- <th scope="col">Add Date</th>
                    <th scope="col">Price</th> -->
                    
					          <!-- <th scope="col">Drop</th> -->
                  </tr>
                </thead>
                <tbody>
                
<?php  
	while($result=mysqli_fetch_array($query2))
  { 
    echo'<tr>';
    echo "<td>".$result['cat_id']."</td>";
    echo "<td>".$result['cat_name']."</td>";
	echo"<td><a href=cateDetails.php?id='".$result['cat_id']."'><button class='btn btn-danger btn-sm'>Details</button</a></td>";
    echo "<form action='deleCate.php' method='post'><td><input type='hidden' name='id' value=".$result['cat_id']."><input type='submit' name='delete' value='Delete' class='btn btn-danger btn-sm'></td></tr></form>";

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
