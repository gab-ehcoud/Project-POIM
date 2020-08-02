<?php include('server.php'); ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['Ft_Id'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Ft_Id']);
    header("location: login.php");
  }
$ft_id= $_SESSION['Ft_Id'];
//fetching area code
$query1 = "SELECT * FROM power_outage WHERE Ft_Id = '$ft_id' ";
$result1 = mysqli_query($db, $query1);
if (isset($result1)){
$ft1 = mysqli_fetch_assoc($result1);
}
//
$po_ar_mod= $ft1['Module_No'];
// Select all the rows in the markers table
$query3 = "SELECT * FROM markers WHERE Module_No= '$po_ar_mod'";
$result3 = mysqli_query($db, $query3);
if (isset($result3)){
$mar_loc = mysqli_fetch_assoc($result3);
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FixingTeam</title>
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="assets/img/BeFunky-design%20(45).png">
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="assets/img/BeFunky-design%20(45).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="assets/css/Bottom-Resonsive-Menu.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body><iframe allowfullscreen="" frameborder="0" src="http://poimclient.epizy.com/ft/gmapsindex.php" width="100%" height="400" style="height: 370px;"></iframe><button class="btn btn-primary" type="button" style="width: 95%;padding: 0px 0px 0px 0px;height: 40px;background-color: rgb(0,119,205);margin: 10px;" onclick="return loc_redirect()">Get Direction</button>
    <div
        class="card">
        <div class="card-body" style="padding: 0px 17px 5px 17px;">
            <h5 class="card-title">Problem Id= <?php echo $ft1["Sno"];?></h5>
        </div>
        </div>
        <h4 class="text-center">Status: <?php echo $ft1["Status"];?></h4>
        <div>
      <form method="post" action="index.php">      
    <div class="form-row">
        <div class="col-md-6" style="width: 50%;"><a href="confirm.php"><button class="btn btn-primary" type="button" style="width: 100%;padding: 0px 0px 0px 0px;height: 40px;background-color: rgb(255,138,0);">Confirm</button></a></div>
        <div class="col"><button class="btn btn-primary" type="submit" name="stat_sol" style="width: 100%;padding: 0px 0px 0px 0px;height: 40px;background-color: rgb(41,205,0);">Solved</button></div>
    </div>
</form>
        </div><a href="change_report.php"><button class="btn btn-primary" type="button" style="width: 95%;padding: 0px 0px 0px 0px;height: 40px;background-color: rgb(0,119,205);margin: 10px;">Change Report (If Required)</button></a>
        <div>
            <div class="container">
                <div class="row">
                   <div class="col-md-6" style="width: 50%;"><a href="inventory.html"> <button class="btn btn-primary" type="button" style="width: 100%;padding: 0px 0px 0px 0px;height: 40px;background-color: rgb(0,119,205);">+ Request</button></a></div>
                    <div class="col-md-6" style="width: 50%;"><button class="btn btn-primary" type="button" style="width: 100%;padding: 0px 0px 0px 0px;height: 40px;background-color: rgb(252,15,0);" onclick="alert1()">SOS Emergency</button></div>
                </div>
            </div>
        </div>
<script type="text/javascript">
        function loc_redirect(){
            var lat= <?php echo $mar_loc['lat']; ?>;
            var long= <?php echo $mar_loc['lng']; ?>;
            window.location.replace('https://www.google.com/maps/dir///@'+ lat + ','+ long+',15z','_blank');
        }
        function alert1(){
	alert("SOS Message SENT ");
}
    </script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
