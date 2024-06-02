<?php
include './inc/db.php';

session_start();



if (isset($_POST["submit"])) {
        $str = $_POST['mobileno'];
        $mobileno = preg_split('/\r\n|\n|\r/', $str);
        $mobile_no_count = 0;
        // $msg_details_sql = "";
        foreach ($mobileno as $mobilenos) {
            $mobile_no_count++;
            // print_r($mobilenos);
            // echo "====";
            if($mobilenos!="")
            {
                $msg_details_sql = "INSERT INTO `whitelist`(`mobile_number`) VALUES ('$mobilenos')";
                mysqli_query($conn, $msg_details_sql);
            }
           
            // mysqli_query($conn, $msg_details_sql);     
        }
        header('location:whitelist.php');


        // if ($conn->multi_query($msg_details_sql) === TRUE) {
        //     echo "<script> alert('New records created successfully')</script>";

         
            
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // 	die();
        // }

       
} 
?>

