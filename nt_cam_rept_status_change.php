<?php
include './inc/db.php';
$cheks = implode("','", $_POST['checkbox']);


$sql = "UPDATE `send_msg_details` SET `status`='Failed' WHERE id in ('$cheks')";
$result = mysqli_query($conn, $sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
