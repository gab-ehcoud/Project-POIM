<?php include('server.php') ?>
<?php 
  session_start(); 
  $Ft_Id="";

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
  $query_pow = "SELECT * FROM power_outage WHERE Ft_Id = '$ft_id' ";
$result1_po = mysqli_query($db, $query_pow);
if (isset($result1_po)){
$ft2 = mysqli_fetch_assoc($result1_po);
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
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Bottom-Resonsive-Menu.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Newsletter-Subscription-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Seleted Problem Data</h4>
            <h6 class="text-muted card-subtitle mb-2">THE DATA SHOWN TO THE CONSUMERS</h6>
            <div class="card" style="margin: 20px 0px ;">
                <div class="card-body">
                    <h4 class="card-title">Problem ID : <?php echo $ft2["Sno"];?></h4>
                    <h5 class="text-muted card-subtitle mb-2">PROBLEM TITLE : <?php echo $ft2["Problem_Title"];?></h5>
                    <h5 class="text-muted card-subtitle mb-2">EST TIME : <?php echo $ft2["Est_Time"];?></h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-clean">
        <form method="post" action="change_report.php">
            <h2 class="text-center">Edit the report</h2>
            <div class="form-group"><input class="form-control" type="text" name="pt1"  placeholder="New Problem Title" required="" value="<?php echo $ft2['Problem_Title'] ;?>"></div>
            <div class="form-group"><input class="form-control" type="number" name="et1" min="0" max="1000" placeholder="New Estimated Time" value="<?php echo $ft2['Est_Time'] ;?>></div>
            <div class="form-group text-center"><center><button class="btn btn-secondary" type="submit"  name="report_new" style="background-color: #00a80a;">report</button></div></center>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
