<?php include('server.php') ?>
<?php
$Emp_Id = "";
$Emp_Name = "";
$Emp_Branch = "";


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

<body style="padding: 3px;">
    <div class="highlight-blue" style="margin: 0px 0px 10px 0px;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Employee Verification</h2>
                <p class="text-center">ENTER THE EMPLOYEE ID</p>
            </div>
<form method="GET" action="emp_verf.php">
            <?php include('errors.php'); ?>
            <div class="form-group"><input class="form-control" type="text" name="Emp_Id" placeholder="Enter the ID"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: Blue;" name="emp_search">SEARCH</button></div>
</form></div>
    </div>
<?php
	if(empty($emp_ver2))
		{
			echo '<script>alert("No Employee Found")</script>';
}	
?>
<img class="rounded-circle" src="assets/img/ZPtE0hsG_400x400.jpg" style="width: 150px;height: 150px;margin: 0px 25% 0px 25%;">
    <h3>EMP ID: <?php echo $emp_ver2["Emp_Id"];?></h3>
    <h3>Name: <?php echo $emp_ver2["Emp_Name"];?></h3>
    <h3>From Branch: <?php echo $emp_ver2["Emp_Branch"];?></h3>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
</body>

</html>
