<?php include('connect.php'); ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['Ft_Id'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Ft_Id']);
    header("location: login.php");
  }
?>
<?php
require("phpsqlajax_dbinfo.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server
$connection=mysqli_connect ('sql301.epizy.com', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection,$database);
if (!$db_selected) {
  die ('Cant use db : ' . mysqli_error());
}
$ft_id_us= $_SESSION['Ft_Id'];
//fetching area code
$query1 = "SELECT * FROM ft_users WHERE Ft_Id = '$ft_id_us' ";
$result1 = mysqli_query($db, $query1);
$ft_us = mysqli_fetch_assoc($result1);
if (!$result1) {
  die('Invalid query: ' . mysqli_error());
}
$ft_us_arcode= $ft_us['Area_Code'];
//fetching power outage query
$query2 = "SELECT * FROM power_outage WHERE Area_Code='$ft_us_arcode' ";
$result2 = mysqli_query($db, $query2);
$po_ar = mysqli_fetch_assoc($result2);
if (!$result2) {
  die('Invalid query: ' . mysqli_error());
}
$po_ar_mod= $po_ar['Module_No'];
// Select all the rows in the markers table
$query = "SELECT * FROM markers WHERE Module_No= '$po_ar_mod'";
$result = mysqli_query($db, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<marker>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['id'] . '" ';
  echo 'Module_No="' . parseToXML($row['Module_No']) . '" ';
  echo 'Area_Code="' . parseToXML($row['Area_Code']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'type="' . $row['type'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</marker>';

?>
