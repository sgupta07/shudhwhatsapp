<?php session_start();
include "./inc/db.php";

        $credit_type = $_POST['credit_type'];
        $per_sms_price = $_POST['per_sms_price'];
        $credit_type_nota = $_POST['credit_type_nota'];
        $no_of_sms = $_POST['no_of_sms'];
        $description = $_POST['description'];
        $is_tax =0;//$_POST['is_tax'];
        $id = $_POST['uniqueid'];
       // die();
        $query = "SELECT * FROM `user_details` where id='" . $_SESSION['User_ID'] . "'";
        $select_data = mysqli_query($conn, $query);
        $count = 0;
        $wn = 0;
        $wi = 0;
        $wb = 0;
        while ($row = mysqli_fetch_array($select_data)) {
            $count++;
            $wn = $row['wn'];
            $wi = $row['wi'];
            $wb = $row['wb'];
            // die();
            $user_wn = 0;
            $user_wi = 0;
            $user_wb = 0;
            $sql = "SELECT * FROM `user_details` where id='$id'";
            $select_user = mysqli_query($conn, $sql);
            while ($row_user = mysqli_fetch_array($select_user)) {
                 $user_wn = $row_user['wn'];
                 $user_wi = $row_user['wi'];
                 $user_wb = $row_user['wb'];
            }

            if ($credit_type == 'add') {

                if ($credit_type_nota == 1) {
                    if ($wn >= $no_of_sms) {
                        $user_wn += $no_of_sms;
                        $wn -= $no_of_sms;
                    } else {
                        echo "<script>alert('Insufficient balance');</script>";
                    }
                } else if ($credit_type_nota == 2) {
                    if ($wi >= $no_of_sms) {
                        $user_wi += $no_of_sms;
                        $wi -= $no_of_sms;
                    } else {
                        echo "<script>alert('Insufficient balance');</script>";
                    }
                }else if ($credit_type_nota == 3) {
                    if ($wb >= $no_of_sms) {
                        $user_wb += $no_of_sms;
                        $wb -= $no_of_sms;
                    } else {
                        echo "<script>alert('Insufficient balance');</script>";
                    }
                }
                $update_user1 = "INSERT INTO `transaction`(`user_id`, `no_of_sms`, `per_sms_price`, `sms_type`, `description`, `created_by`, `created`, `include_tax`)";
                $update_user1 .= "VALUES ($id,$no_of_sms,'$per_sms_price',$credit_type_nota,'$description','" . $_SESSION['User_ID'] . "',now(),$is_tax)";
            
                $inser_transaction = mysqli_query($conn, $update_user1);
                if (!$inser_transaction) {
                    die('QUERY FAILD ' . mysqli_error($conn));
                }
            } else {
                if ($credit_type_nota == 1) {
                    if ($user_wn >= $no_of_sms) {
                        $user_wn -= $no_of_sms;
                        $wn += $no_of_sms;
                    } else {
                        echo "<script>alert('Insufficient balance');</script>";
                    }
                } else if ($credit_type_nota == 2) {
                    if ($user_wi >= $no_of_sms) {
                        $user_wi -= $no_of_sms;
                        $wi += $no_of_sms;
                    } else {
                        echo "<script>alert('Insufficient balance');</script>";
                    }
                }
                else if ($credit_type_nota == 3) {
                    if ($user_wb >= $no_of_sms) {
                        $user_wb -= $no_of_sms;
                        $wb += $no_of_sms;
                    } else {
                        echo "<script>alert('Insufficient balance');</script>";
                    }
                }
            }
               if ($user_wn == '') {
        $user_wn = 0;
    }
    if ($user_wi == '') {
        $user_wi = 0;
    }
    if ($user_wb == '') {
        $user_wb = 0;
    }

    if ($wn == '') {
        $wn = 0;
    }
    if ($wi == '') {
        $wi = 0;
    }
    if ($wb == '') {
        $wb = 0;
    }

            $update_user1 = "UPDATE `user_details` SET `wn`=$user_wn,`wi`=$user_wi,`wb`=$user_wb where id='$id'";
           $update_user_balance1 =  mysqli_query($conn, $update_user1);
            if (!$update_user_balance1) {
                die('QUERY FAILD ' . mysqli_error($conn));
            }
            
            $update_user2 = "UPDATE `user_details` SET `wn`=$wn,`wi`=$wi,`wb`=$wb  where id='" . $_SESSION['User_ID'] . "'";
           $update_user_balance2 = mysqli_query($conn, $update_user2);
            if (!$update_user_balance2) {
                die('QUERY FAILD ' . mysqli_error($conn));
            }
        }
       echo "<script>window.location.href = './dashboard.php?msg=1';</script>";//alert('Record Saved Successfully');

        ?>
