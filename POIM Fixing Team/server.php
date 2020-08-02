<?php include('connect.php') ?>
<?php
session_start();

// initializing variables
$Ft_Id = "";
$Team_No   = "";
$con_id = "";
$et1 = "";
$pt1="";
$errors = array(); 

// connect to the database


// REGISTER USER
if (isset($_POST['Ft_Reg'])) {
  // receive all input values from the form
  $Ft_Id = mysqli_real_escape_string($db, $_POST['Ft_Id']);
  $Team_No = mysqli_real_escape_string($db, $_POST['Team_No']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password-repeat']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Ft_Id)) { array_push($errors, "Ft_Id number is required"); }
  if (empty($email)) { array_push($errors, "Team_No is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM ft_users WHERE Ft_Id='$Ft_Id' OR Team_No='$Team_No' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Ft_Id'] === $Ft_Id) {
      array_push($errors, "Ft_Id number already exists");
    }
}

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO ft_users (Ft_Id, Team_No, password) 
  			  VALUES('$Ft_Id', '$Team_No', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['Ft_Id'] = $Ft_Id;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 
// LOGIN USER
if (isset($_POST['fix_team'])) {
  $Ft_Id = mysqli_real_escape_string($db, $_POST['Ft_Id']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($Ft_Id)) {
    array_push($errors, "Ft_Id Number is reuired");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM ft_users WHERE Ft_Id='$Ft_Id' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['Ft_Id'] = $Ft_Id;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM users WHERE email='$email'";
  $results = mysqli_query($db, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($db, $sql);

    // Send email to user with the token in a link they Ft_Idn click on
    $to = $email;
    $subject = "Reset your password on examplesite.com";
    $msg = "Hi there, click on this <a href=\"new_password.php?token=" . $token . "\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    $headers = "From: info@examplesite.com";
    mail($to, $subject, $msg, $headers);
    header('location: pending.php?email=' . $email);
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);

  // Grab to token that Ft_Idme from the email link
  $token = $_SESSION['token'];
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
      $results = mysqli_query($db, $sql);
      header('location: index.php');
    }
  }
}
//confirmation
if (isset($_POST['confirm1'])) {
  // receive all input values from the form
  $con_id = mysqli_real_escape_string($db, $_POST['conID']);

$Ft1_Id=$_SESSION['Ft_Id'];	

if (count($errors) == 0) {
	$query4 = "UPDATE `power_outage` SET `Status`='Processing',`Ft_Id`= '$Ft1_Id' WHERE Sno= '$con_id'";
	mysqli_query($db, $query4);
}
}
//confirmation
$Fttt_Id=$_SESSION['Ft_Id'];
if (isset($_POST['stat_sol'])) {
	
  // receive all input values from the form
  if (count($errors) == 0) {
	$query5 = "DELETE FROM `power_outage` WHERE Ft_Id= '$Fttt_Id'";
	mysqli_query($db, $query5);
	header('location: index.php');
}

}
$Ftt_Id=$_SESSION['Ft_Id'];	
if (isset($_POST['report_new'])) {
  // receive all input values from the form
  $pt1 = mysqli_real_escape_string($db, $_POST['pt1']);
  $et1 = mysqli_real_escape_string($db, $_POST['et1']);


if (count($errors) == 0) {
	$query9 = "UPDATE `power_outage` SET Problem_Title='$pt1', Est_Time = '$et1' WHERE Ft_Id= '$Ftt_Id'";
	mysqli_query($db, $query9);
}
}


?>
