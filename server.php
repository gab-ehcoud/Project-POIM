<?php include('connect.php') ?>
<?php
session_start();

// initializing variables
$CA = "";
$email    = "";
$uCA = "";
  $uemail="";
$errors = array(); 


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $CA = mysqli_real_escape_string($db, $_POST['CA']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password-repeat']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($CA)) { array_push($errors, "CA number is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE CA='$CA' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['CA'] === $CA) {
      array_push($errors, "CA number already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (CA, email, password) 
  			  VALUES('$CA', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['CA'] = $CA;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
  $CA = mysqli_real_escape_string($db, $_POST['CA']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($CA)) {
    array_push($errors, "CA Number is reuired");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE CA='$CA' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['CA'] = $CA;
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

    // Send email to user with the token in a link they can click on
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

  // Grab to token that came from the email link
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
if (isset($_GET['emp_search'])) {
  $Emp_Id1 = mysqli_real_escape_string($db, $_GET['Emp_Id']);

  if (empty($Emp_Id1)) {
    array_push($errors, "You havent write anything");
  } else{
  $queryemp = "SELECT * FROM emp WHERE Emp_Id= '$Emp_Id1'";
    $emp_ver = mysqli_query($db, $queryemp);
     $emp_ver2 = mysqli_fetch_assoc($emp_ver);
}
}
//streetlgiht
// 
$poll_no="";
$problem="";
if (isset($_POST['street_light'])) {
  // receive all input values from the form
  $poll_no = mysqli_real_escape_string($db, $_POST['poll_no']);
  $problem = mysqli_real_escape_string($db, $_POST['problem_title']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($poll_no)) { array_push($errors, "Poll number is required"); }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query5 = "INSERT INTO `street_lights`(`Poll_No`, `Problem_Title`) VALUES ('$poll_no', '$problem')";
  	mysqli_query($db, $query5);
  	header('location: index.php');
  }
}
//profile update
if (isset($_POST['update_profile'])) {
  // receive all input values from the form
  $uCA = mysqli_real_escape_string($db, $_POST['uCA']);
  $uemail = mysqli_real_escape_string($db, $_POST['uemail']);

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_update_query = "SELECT * FROM users WHERE CA='$uCA' OR email='$uemail' LIMIT 1";
  $update_profile_q = mysqli_query($db, $user_update_query);
  $user1 = mysqli_fetch_assoc($update_profile_q);

$current_ca= $user1['CA'];
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$query_up = "UPDATE `users` SET `CA`= '$uCA',`email`='$uemail' WHERE CA='$current_ca'";
  	mysqli_query($db, $query_up);
  	
  }
}

?>

