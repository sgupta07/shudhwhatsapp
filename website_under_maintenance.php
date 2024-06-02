<?php
include "./inc/db.php";
 $status = 0;
$query = "select * from website_on_off";
$select_userprofile_image1 = mysqli_query($conn, $query);
while ($row1 = mysqli_fetch_array($select_userprofile_image1)) {
    $status = $row1['status'];
}

if ($status == 0) {
    header("location:index.php");
}
?>
<html>

<head>
    <title>Website Under Maintenance</title>
</head>
<body>
    <h1>Website Under Maintenance</h1>
</body>
</html>