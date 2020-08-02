<?php include('server.php'); ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['Agent_Id'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Agent_Id']);
    header("location: login.php");
  }

//run power outage database
 $power_outage_last_upadte = "SELECT * FROM power_outage WHERE Sno=(SELECT max(Sno) FROM power_outage)";
$query7 = mysqli_query($db, $power_outage_last_upadte); 
$last = mysqli_fetch_assoc($query7);

//total outgae problem
$total_power_outage="SELECT count(*) as total FROM power_outage WHERE Reported_Time >= NOW() - INTERVAL 1 DAY";
$query8 = mysqli_query($db, $total_power_outage);
$total1 = mysqli_fetch_assoc($query8);

//Active outgae problem
$active_power_outage="SELECT count(*) as active FROM power_outage WHERE Status= ('Detected' OR 'Proccesed' OR 'Solving') AND Reported_Time >= NOW() - INTERVAL 1 DAY ";
$query9 = mysqli_query($db, $active_power_outage);
$active1 = mysqli_fetch_assoc($query9);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>POIM CR</title>
    <meta name="theme-color" content="rgb(0,10,255)">
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="assets/img/BeFunky-design%20(45).png">
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/BeFunky-design%20(45).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Bottom-Resonsive-Menu.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body><iframe allowfullscreen="" frameborder="0" src="https://cdn.bootstrapstudio.io/placeholders/map.html" width="100%" height="400"></iframe>
   <center> <div class="col-lg-6 mb-4">
        <div class="card text-white bg-info shadow">
            <div class="card-body border rounded">
                <a href="all_prob_insights.php" style="color:white"><p class="text-center m-0" style="font-size: 20px;padding: 1px;margin: 2px;">ALL PROBLEMS INSIGHTS&nbsp;</p></a>
            </div>
        </div>
    </div></center>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="width: 50%;">
                    <div class="card">
                        <div class="card-body" style="background-color: #ffb45b;">
                            <h6 class="text-center card-title">Total Problem</h6>
                            <h5 class="text-center" style="color: rgb(255,255,255);"><?php echo $total1["total"];?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="width: 50%;">
                    <div class="card">
                        <div class="card-body" style="background-color: #ff6363;">
                            <h6 class="text-center card-title">Active Problem</h6>
                            <h5 class="text-center" style="color: rgb(255,255,255);"><?php echo $active1["active"];?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="width: 50%;margin: 10px 0px 0px 0px;">
                    <div class="card">
                        <div class="card-body" style="background-color: #fff742;">
                            <a href="fixing_team_management.php" style="color:white"><h6 class="text-center card-title">Fixing team management</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="width: 50%;margin: 10px 0px 0px 0px;">
                    <div class="card">
                        <div class="card-body" style="background-color: #637cff;">
                      <a href="outage_manual.php" style="color:white">      <h6 class="text-center card-title">Add a Problem Info manual</h6></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
