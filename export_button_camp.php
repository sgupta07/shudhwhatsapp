<?php
//include database configuration file
session_start();
include './inc/db.php';
mysqli_set_charset($conn, 'utf8');
$User_ID = $_SESSION['User_ID'];
$id=$_GET['uniqueid'];
//get records from database
$sql = "SELECT * FROM `b_send_whatsapp` where send_id='$id'";
$query = $conn->query($sql);

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "Process_" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('Unique Id', 'Username', 'Mobile No.', 'Status', 'Create At', 'Completed At');
    fputcsv($f, $fields, $delimiter);
    $count = 0;
     $url='';
    while ($row = $query->fetch_assoc()) {
        $count++;
       

     
        $lineData = array($count, $_SESSION['user_name'], $row['mobNumbar'], $row['status'], '', '');
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;
