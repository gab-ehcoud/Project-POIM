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
//
$query11 = "SELECT count(*) as total_team FROM power_outage po INNER JOIN fixing_team ft WHERE po.Ft_Id = ft.Ft_Id ";
$result11 = mysqli_query($db, $query11);
$active_team = mysqli_fetch_assoc($result11);

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
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
    <div class="highlight-blue" style="height: 101px;padding: 25px 0px;">
        <div class="container">
            <div class="intro">
                <h1 class="text-center" style="margin: 0px;">Insights</h1>
            </div>
        </div>
    </div>
<center>
    <div class="team-boxed">
        <div class="container">
            <div class="intro"></div>
        </div>
    </div>
    <div class="col-lg-6 mb-4" style="margin: 10px 0px 0px 0px;">
        <div class="card text-white bg-info shadow">
            <div class="card-body border rounded">
              <a href="all_prob_insights.php" style="color:white">  <p class="m-0" style="font-size: 13px;padding: 1px;margin: 2px;">TOTAL PROBLEMS DETECTED : <?php echo $total1["total"];?></p></a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4" style="margin: 10px 0px 0px 0px;">
        <div class="card text-white bg-info shadow" style="background-color: rgb(255,95,95);">
            <div class="card-body border rounded" style="background-color: #ff7c7c;">
              <a href="all_prob_insights.php" style="color:white">    <p class="m-0" style="font-size: 13px;padding: 1px;margin: 2px;">ACTIVE PROBLEMS : <?php echo $active1["active"];?></p></a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4" style="margin: 10px 0px 0px 0px;">
        <div class="card text-white bg-info shadow">
            <div class="card-body border rounded" style="background-color: #3fff47;">
                <p class="m-0" style="font-size: 13px;padding: 1px;margin: 2px;">ACTIVE FIXING TEAMS : <?php echo $active_team["total_team"];?></p>
            </div>
        </div>
    </div>
</center>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="width: 50%;">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body border rounded" style="background-color: #94a9a4;width: 100%;">
                            <p class="text-center m-0" style="font-size: 13px;padding: 1px;margin: 2px;">TRANFORMERS OVERHEATED</p>
                            <h5 class="text-center" style="color: rgb(0,0,0);">N/A</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="width: 50%;">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body border rounded" style="background-color: #ff1809;">
                            <p class="text-center m-0" style="font-size: 13px;padding: 1px;margin: 2px;">TOTAL NO. OF AREA AFFECTED</p>
                            <h5 class="text-center" style="color: rgb(0,0,0);"><?php echo $active1["active"];?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
    <div></div>
<center>
    <div class="col-lg-7 col-xl-8" style="margin: 10px 0px 0px 0px;">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">POWER OUTAGE SUMMARY</h6>
                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                        role="menu">
                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>
            </div>
        </div>
    </div>
</center>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
