<?php
$db = mysqli_connect('sql106.epizy.com', 'epiz_26406772', 'b2XAyYwf8gbzhpa', 'epiz_26406772_poim');

// Check connection
if ($db -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
