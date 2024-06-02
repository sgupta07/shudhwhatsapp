<?php session_start();
include "./inc/db.php";
if (isset($_POST['update'])) {
    $User_ID =   $_SESSION['User_ID'];
    $old_pswd = $_POST['current_pass'];
    $new_pswd = $_POST['new_pass'];
    $confirm_pswd = $_POST['renew_pass'];
    $update_psqd = "UPDATE `user_details` SET `password`='$new_pswd' WHERE `id`='$User_ID' and password='$old_pswd'";
    $update_password = mysqli_query($conn, $update_psqd);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($conn));
    } else {
        echo "<script>alert('password change successfully');window.location.href = './login_pass.php';</script>";
        // return 'pass';
    }
}
