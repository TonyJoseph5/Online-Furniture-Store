<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .text-font{
            font-size: 35px;
            font-weight: bolder;
        }
        .height{
            height: 100vh   ;
        }
        
    </style>
       
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 bg-light height">
               
            </div>
            <div class="col-sm-10 bg-light">
               <div class="row">
                   <div class="col-sm-2">
                       <p class="text-center pt-5">
                                    <!-- <img class="rounded" src="<?php echo ("/test123/profile-pic/") . ($_SESSION['email']) . "display-picture.jpg"; ?>" width="150px" height="140px"> -->
                                </p>
                   </div>
                   
               </div>
                <div class="row ">
                    <div class="col-sm-10">
                        <p class="text-center">
                            <strong>Add categories</strong>
                        </p>
                        <form class="form-control mx-auto w-50" action="" method="post">
                            <label class="pt-2 pb-4 text-center">Enter a category</label>
                            <input class="form-control" type="text" id="category" placeholder="Enter a category">
                            <br>
                            <input type="button" class="form-control  btn btn-primary" onclick="addcategory()" value="Add a category">
                            <div class="error pt-2"></div><div class="pt-2 success"></div>
                        </form>
                        <p class="text-center pt-3">
                            <strong>Add Sub-categories</strong>
                        </p>
                        <form class="form-control mx-auto w-50" action="" method="post">
                            <label class="pt-2 pb-4 text-center" for="categories">Choose a category</label>
                            <select class="form-control" id="categories" name="categories">
                                <option value="">select</option>
                            <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
                                     <option value="<?php echo $row['id'];?>"><?php echo ($row['name']); ?></option>
                             <?php } ?>
                             </select>
                             <br>
                            <label class="pt-1 pb-4 text-center">Enter a sub category</label>
                            <input class="form-control" type="text" id="subcategory" placeholder="Enter a sub category">
                            <br>
                            <input type="button" class="form-control btn btn-primary" onclick="addsubcategory()" value="Add a Sub category">
                            <div class="error1 pt-2"></div><div class="success1 pt-2"></div>
                        </form>
                    </div>
                    
                    <div class="error2"></div><div class="success2"></div>
                    
                </div>
            </div>
        </div>
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>