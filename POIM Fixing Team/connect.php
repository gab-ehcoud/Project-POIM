<?php
$db = mysqli_connect('sql301.epizy.com', 'epiz_26346287', '5CwS2JifGdMy', 'epiz_26346287_poimclient');

// Check connection
if ($db -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>