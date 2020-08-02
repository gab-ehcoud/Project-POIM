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

//run power outage database
 $all_outage_upadte = "SELECT * FROM power_outage WHERE 1 ORDER BY Sno DESC";
$query10 = mysqli_query($db, $all_outage_upadte); 


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
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #00a80a;">All Problems' Insights&nbsp;</h4>
            <h6 class="text-muted card-subtitle mb-2">Last Updated: <?php echo $last["Reported_Time"];?></h6>
            <div class="row padMar">
                <div class="col padMar">
                    <div class="input-group">
                        <div class="input-group-prepend"></div><input class="form-control autocomplete" type="text" placeholder="Search" name="seach">
                        <div class="input-group-append"><button class="btn btn-warning" type="button" style="background-color: #00a80a;"><i class="fa fa-search"></i></button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">Table Matters</p>
<table class="table">
    <thead>
        <tr>
            <th>Area Code</th>
            <th>Problem Title</th>
            <th>Est_Time</th>
            <th>Status</th>
            <th>Module No.</th>
            <th>Reported Time</th>
        </tr>
    </thead>
    <tbody>
          <?php
	if (isset($query10)) {
	while($row = mysqli_fetch_assoc($query10)) {
	echo "<tr><td>" . $row["Area_Code"]. "</td><td>" . $row["Problem_Title"] . "</td><td>"
	. $row["Est_Time"]. "</td><td>". $row["Status"]. "</td><td>". $row["Module_No"]. "</td><td>". $row["Reported_Time"]. "</td></tr>";
	}
	echo "</table>";
	} else { echo "0 results"; }
?>
    </tbody>
</table>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
