<?php
// date_default_timezone_set("Asia/Calcutta");

// shudhwhatsapp_whatsapp
// Access
// : Localhost
// Password
// : 3f@MMdX1vfdH
$host = 'localhost';
$user = 'shudhwhatsapp_whatsapp';
$password = '3f@MMdX1vfdH';
$database = 'shudhwhatsapp_whatsapp';
 $conn = mysqli_connect($host, $user, $password, $database);
// $conn = mysqli_connect('localhost', 'smssoot_whatsapp', '3N$lEBo5DT2B', 'smssoot_whatsapp');
  $conn->set_charset('utf8mb4');
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>