<?php include('connect.php') ?>
<?php
session_start();

// initializing variables
$Agent_Id = "";
$email    = "";
$ac = "";
  $pt = "";
  $et = "";
  $mno = "";

$errors = array(); 

// connect to the database


// REGISTER USER
if (isset($_POST['agent_user'])) {
  // receive all input values from the form
  $Agent_Id = mysqli_real_escape_string($db, $_POST['Agent_Id']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password-repeat']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Agent_Id)) { array_push($errors, "Agent_Id number is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM agents WHERE Agent_Id='$Agent_Id' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Agent_Id'] === $Agent_Id) {
      array_push($errors, "Agent_Id number already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO agents (Agent_Id, email, password) 
              VALUES('$Agent_Id', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['Agent_Id'] = $Agent_Id;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}

// ... 
// LOGIN USER
if (isset($_POST['login_agent'])) {
  $Agent_Id = mysqli_real_escape_string($db, $_POST['agent_id']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($Agent_Id)) {
    array_push($errors, "Agent_Id Number is reuired");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM agents WHERE Agent_Id='$Agent_Id' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['Agent_Id'] = $Agent_Id;
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

    // Send email to user with the token in a link they Agent_Idn click on
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

  // Grab to token that Agent_Idme from the email link
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
//mauanlly power
if (isset($_POST['manual_power'])) {
  // receive all input values from the form
  $ac = mysqli_real_escape_string($db, $_POST['ac']);
  $pt = mysqli_real_escape_string($db, $_POST['pt']);
  $et = mysqli_real_escape_string($db, $_POST['et']);
  $mno = mysqli_real_escape_string($db, $_POST['mno']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($ac)) { array_push($errors, "Area Code is Required"); }
  if (empty($pt)) { array_push($errors, "Problem Title is Required"); }
  if (empty($et)) { array_push($errors, "Estimated time is required"); }
  if (empty($mno)) { array_push($errors, "Module Number is required");}

  

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    $query6 = "INSERT INTO `power_outage`( `Area_Code`, `Problem_Title`, `Est_Time`, `Module_No`) VALUES ('$ac','$pt','$et','$mno')";
    mysqli_query($db, $query6);
  
}
}
if (isset($_POST['planned_outage'])) {
  // receive all input values from the form
  $poac = mysqli_real_escape_string($db, $_POST['poac']);
  $podt = mysqli_real_escape_string($db, $_POST['podt']);
  $poet = mysqli_real_escape_string($db, $_POST['poet']);
  $message = mysqli_real_escape_string($db, $_POST['message']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($poac)) { array_push($errors, "Area Code is Required"); }
  if (empty($podt)) { array_push($errors, "Date and Time is Required"); }
  if (empty($poet)) { array_push($errors, "Estimated time is required"); }

  

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    $query7 = "INSERT INTO `planned_outgae`( `Area_Code`, `Planned_Dt`, `Est_Time`, `Message`) VALUES ('$poac','$podt','$poet','$message')";
    mysqli_query($db, $query7);
  
}
}
if (isset($_POST['send_message'])) {
  // receive all input values from the form
  $mt = mysqli_real_escape_string($db, $_POST['mt']);
  $message1 = mysqli_real_escape_string($db, $_POST['message1']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($mt)) { array_push($errors, "Message Title is Required"); }
  if (empty($message1)) { array_push($errors, "Message is Required"); }

  

  // Finally, register user if there are no errors in the form
 if (count($errors) == 0) {

    $query8 = "INSERT INTO `send_message`( `Message_Title`, `Message`) VALUES ('$mt','$message1')";
    mysqli_query($db, $query8);
  
}
}
?>