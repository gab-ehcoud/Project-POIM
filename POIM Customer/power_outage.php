<?php include('connect.php') ?>
<?php 
  session_start(); 
  $ca_no="";

  if (!isset($_SESSION['CA'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['CA']);
    header("location: login.php");
  }
  $ca_no= $_SESSION['CA'];
  $ca_details_query = "SELECT * FROM CA_details WHERE CA= '$ca_no'";
$query1 = mysqli_query($db, $ca_details_query);
$ca_det = mysqli_fetch_assoc($query1);
  $ac= $ca_det["Area_Code"];
  $power_outage_query = "SELECT * FROM power_outage WHERE Area_Code= '$ac'";
  $query2= mysqli_query($db, $power_outage_query);
  $po_det = mysqli_fetch_assoc($query2);
if (empty($po_det)) {
            $problemdetect= "No Power Outage Detected";
            $Est_Time= "N/A";
	    $status= "All Working";
		$bgcolor= "#00a80a";

        } else 
            {
               $problemdetect= $po_det["Problem_Title"];
            $Est_Time= $po_det["Est_Time"];
	    $status= $po_det["Status"];
		$bgcolor= "red";
}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>POIM</title>
    <meta name="theme-color" content="#00a80a">
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="assets/img/BeFunky-design%20(45).png">
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="assets/img/BeFunky-design%20(45).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/css/Bottom-Resonsive-Menu.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Header-Novos-Imveis.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/menu-cinel-1.css">
    <link rel="stylesheet" href="assets/css/menu-cinel.css">
    <link rel="stylesheet" href="assets/css/Newsletter-Subscription-Form.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="margin: 11px;">

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Power Outage Information</h4>
            <h6 class="text-muted card-subtitle mb-2">CA Number: <?php echo $ca_det["CA"];?></h6>
        </div>
    </div>
    <div class="highlight-blue" style="background-color: <?php echo $bgcolor;?>;">
        <div class="container">
            <div class="intro">
                <h4 class="text-center" id="problem-detect"><?php echo $problemdetect;?></h4>
                <p class="text-center">AREA DETAILS : <?php echo $ca_det["Address"] ."&nbsp Area Code-". $ca_det["Area_Code"];?></p>
            </div>
            <div class="buttons"></div>
        </div>
        <h4 class="text-center" id="Est_Time"> Estimated Time: <?php echo $Est_Time;?><br></h4>
        <div class="buttons"><a class="btn btn-primary" role="button" href="#"><?php echo $status;?></a></div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    
        
</body>

</html>