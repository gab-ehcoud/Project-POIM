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
</head>

<body><iframe allowfullscreen="" frameborder="0" src="https://cdn.bootstrapstudio.io/placeholders/map.html" width="100%" height="400"></iframe>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="width: 100%;">
                    <div class="card">
                        <div class="card-body" style="background-color: #ff6363;">
                            <h6 class="text-center card-title">Active Team</h6>
                            <h5 class="text-center" style="color: rgb(255,255,255);"><?php echo $active_team["total_team"];?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="width: 50%;margin: 10px 0px 0px 0px;">
                    <div class="card">
                        <div class="card-body" style="background-color: #fff742;">
                            <h6 class="text-center card-title">SOS Request</h6>
				<h5 class="text-center" style="color: rgb(255,255,255);">N/A</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="width: 50%;margin: 10px 0px 0px 0px;">
                    <div class="card">
                        <div class="card-body" style="background-color: #637cff;">
                            <h6 class="text-center card-title">Inventory Req</h6>
				<h5 class="text-center" style="color: rgb(255,255,255);">N/A</h5>
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
