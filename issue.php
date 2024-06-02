<?php
 session_start();
 include "./inc/db.php";
 
// if(isset($_POST['problem'])){
$sql="INSERT INTO `support_tickets`(`Issue_id`, `problem`, `last_reply`, `status`, `created_at`, `created_by`)";
$sql .=" VALUES ('".rand()."','".$_POST['problem']."','','Pending',now(),'" . $_SESSION['User_ID'] . "')";

$inser_issue = mysqli_query($conn, $sql);
if (!$inser_issue) {
    die('QUERY FAILD ' . mysqli_error($conn));
}
else{
    echo "<script>window.location.href = './dashboard.php';</script>";//alert('Issue Create Successfull');
}
// }
// else{
//     echo "<script>window.location.href = './dashboard.php';</script>";
// }
