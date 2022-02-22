<?php 
require("conn.php");
include("header.php");
if ((!isset($_SESSION['user'])) && (!isset($_SESSION['psw'])))
{
    echo "<script>alert('Please login');window.location.href='index.php'</script>";
}
$userid=$_SESSION['user'];
if(isset($_POST['pay']))
{
    $sql=mysqli_query($conn,"select * from tbl_bankdetails where login_id='$userid'") or die(mysqli_error($conn));
    $res=mysqli_fetch_array($sql);
    $cc=$_POST['cc'];
    $exp=$_POST['exp'];
    $cvv=$_POST['cvv'];
    if($cc==$res['card_number'] && $exp==$res['expiry_date'] && $cvv==$res['cvv'])
    {
        echo "<script>alert('Payment successfull');window.location.href='userorders.php'</script>";

    }
    else
    {
        echo "<script>alert('Payment  not successfull');</script>";
    }

}
?>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script> 


<style>
    .padding {
    padding: 5rem !important
}

.form-control:focus {
    box-shadow: 10px 0px 0px 0px #ffffff !important;
    border-color: #4ca746;
}
</style>
<script>
function cc_format(value) {
  var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
  var matches = v.match(/\d{4,16}/g);
  var match = matches && matches[0] || ''
  var parts = []
  for (i=0, len=match.length; i<len; i+=4) {
    parts.push(match.substring(i, i+4))
  }
  if (parts.length) {
    return parts.join(' ')
  } else {
    return value
  }
}

onload = function() {
  document.getElementById('cc').oninput = function() {
    this.value = cc_format(this.value)
  }
}
</script>
</head>
<body>
<br><br><br><br>
<form method="post">
<div class="padding">
    <div class="row">
        <div class="container-fluid d-flex justify-content-center">
            <div class="col-sm-8 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"> <span><b>CREDIT/DEBIT CARD PAYMENT</b></span> </div>
                            <div class="col-md-6 text-right" style="margin-top: -5px;"> <img src="https://img.icons8.com/color/36/000000/visa.png"> <img src="https://img.icons8.com/color/36/000000/mastercard.png"> <img style="height:38px;" src="https://img.icons8.com/color/50/000000/rupay.png"> </div>
                        </div>
                    </div>
                    <div class="card-body" style="height: 350px">
                        <div class="form-group"> <label for="cc-number" class="control-label">CARD NUMBER</label> <input id="cc" type="text" class="input-lg form-control cc-number" name="cc" placeholder="•••• •••• •••• ••••" required> </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label for="cc-exp" class="control-label">EXPIRY DATE</label> <input id="datepicker" type="text" class=" form-control"  placeholder="09 / 25"  name="exp" required> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label for="cc-cvc" class="control-label">CVV</label> <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="•••" name="cvv" required> </div>
                            </div>
                        </div>
                        <div class="form-group"> <label for="numeric" class="control-label">CARD HOLDER NAME</label> <input type="text" class="input-lg form-control"> </div>
                        <div class="form-group"> <input value="MAKE PAYMENT" type="submit"  name="pay" class="btn btn-warning  " style="font-size: .8rem;"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script>
$("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});
</script>
</body>
</html>
<br><br><br><br>
<?php
include('footer.php');
?>