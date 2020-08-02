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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Bottom-Resonsive-Menu.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Profile</h5>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 16px;width: 91px;">Name</td>
                                    <td><?php echo $ag_det['Name'];?></td>
                                </tr>
                                <tr>
                                    <td>ID</td>
                                    <td><?php echo $ag_det['Agent_Id'];?></td>
                                </tr>
                                <tr>
                                    <td>Email Id</td>
                                    <td><?php echo $ag_det['email'];?></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><?php echo $ag_det['Location'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="highlight-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Want Some Change</h2>
                <p class="text-center">Contact Admin. Due to Security concern, the change of the password and any other details is only the courtesy of the admin of the app, i.e Techmonks Power Ltd</p>
            </div>
            <center><div class="buttons"><a class="btn btn-primary" role="button" href="tel:+919990808950">Contact</a><a class="btn btn-light" role="button" href="mailto:utkarsh.frankly@gmail.com">mail</a></div>
</center>        
</div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
