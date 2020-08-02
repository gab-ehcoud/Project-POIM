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
$agent_no= $_SESSION['Agent_Id'];
  $agent_details_query = "SELECT * FROM agents WHERE Agent_Id= '$agent_no'";
$query6 = mysqli_query($db, $agent_details_query);
$ag_det = mysqli_fetch_assoc($query6);

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

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-y h:i:s');
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

<body>
    <div class="highlight-blue" style="height: 100px;padding: 30px 0px;">
        <div class="container">
            <div class="intro">
		<?php  if (isset($_SESSION['Agent_Id'])) ; ?>
                <h5 class="text-center">Hi <?php echo $ag_det['Name'];?></h5>
                <h6 class="text-center" style="font-size: 12px;margin: 0px 0px 0px 0px;">Current time: <?php echo $date;?> | Location: <?php echo $ag_det['Location'];?></h6>
            </div>
        </div>
    </div>
    <div class="card" style="margin: 30px 0px 0px 0px;">
        <div class="card-body">
            <h6 class="text-muted card-subtitle mb-2">LAST UPDATED : <?php echo $last["Reported_Time"];?></h6>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body border rounded">
                            <a href="problems.php" style="color:white"><p class="m-0" style="font-size: 13px;padding: 1px;margin: 2px;">TOTAL PROBLEMS DETECTED : <?php echo $total1["total"];?></p></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body border rounded" style="background-color: #ff6262;">
                            <p class="m-0"></p>
                           <a href="problems.php" style="color:white"> <p class="m-0" style="font-size: 13px;padding: 1px;margin: 2px;">ACTIVE PROBLEM : <?php echo $active1["active"];?></p></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
    
        <div class="container">
            <div class="row">
                <div class="col-md-4" style="width: 33.3%;"><a href="insights.php"><img src="assets/img/INSIGHTS.png" style="width: 100%;height: 100PX;"></a></div>
                <div class="col-md-4" style="width: 33.3%;"><a href="planned_outage.php"><img src="assets/img/PLANNED%20OUTAGE.png" style="width: 100%;height: 100PX;"></a></div>
                <div class="col-md-4" style="width: 33.3%;"><a href="inventory.html"><img src="assets/img/INVENTORY.png" style="width: 100%;height: 100PX;"></a></div>
                <div class="col-md-4" style="width: 33.3%;"><a href="coming_soon.html"><img src="assets/img/MANUAL.png" style="width: 100%;height: 100PX;"></a></div>
                <div class="col-md-4" style="width: 33.3%;"><a href="coming_soon.html"><img src="assets/img/TRANFORMER%20HEALTH.png" style="width: 100%;height: 100PX;"></a></div>
                <div class="col-md-4" style="width: 33.3%;"><a href="coming_soon.html"><img src="assets/img/SEETING.png" style="width: 100%;height: 100PX;"></a></div>
            </div>
        </div>
    </div>
    <div class="footer-basic">
        <footer>
            <p class="copyright"></p>
        </footer>
        <nav class="navbar navbar-dark navbar-expand fixed-bottom" style="background-color: #0d161f;height: 55px;">
            <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav flex-grow-1 justify-content-around">
                        <li class="nav-item" role="presentation"><a class="nav-link active btn" href="#"><i class="material-icons" style="font-size: 30px;">home</i></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active btn" href="planned_outage.php"><i class="material-icons" style="font-size: 30px;">add_alert</i></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active btn" href="messages.php"><i class="material-icons" style="font-size: 30px;">mail</i></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active btn" href="agent_profile.php"><i class="material-icons" style="font-size: 30px;">person</i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
