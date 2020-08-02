<?php include('server.php'); ?>
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
    <div class="bg-success login-dark" style="background-color: rgb(3,182,222);height: 667px;min-height: 400px;max-height: 2500px;width: 100%;background-image: url(&quot;assets/img/star-sky.jpg&quot;);">
        <form method="post" action="login.php">
		<?php include('errors.php'); ?>
            <h2 class="sr-only">Login Form</h2>
            <h4 class="text-center" style="color: rgb(33,74,128);">Control room Access</h4>
            <div class="illustration" style="padding: 0;"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="agent_id" placeholder="AGENT ID"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login_agent">Log In</button></div><a class="forgot" href="reset_pass.html">Forgot your email or password?</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
