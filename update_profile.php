<?php
include './inc/db.php';
session_start();
// if (isset($_POST['submit'])) {
    $user_id = $_SESSION['User_ID'];
    $company = $_POST['company'];
    $user_profile = $_FILES['profilepic']['name'];
    $user_profile_file_temp = $_FILES['profilepic']['tmp_name'];
    move_uploaded_file($user_profile_file_temp, "user_profile/$user_profile");
    $query1 = "select * from user_details WHERE  `id`='$user_id'";
    $select_userprofile_image1 = mysqli_query($conn, $query1);
    while ($row1 = mysqli_fetch_array($select_userprofile_image1)) {
        if (empty($user_profile)) {
            $user_profile = $row1['user_profile'];
        }
    }
    $query = "UPDATE `user_details` SET `company_name`='$company',`user_profile`='$user_profile' WHERE `id`='$user_id'";

$update_user = mysqli_query($conn, $query);
if (!$update_user) {
    die('QUERY FAILD ' . mysqli_error($conn));
} else {
    //window.location.href = 'dashboard.php';
    echo "<script>alert('Update User Profile successfully'); window.location.href = 'dashboard.php';";
    echo "</script>";
}
// }
