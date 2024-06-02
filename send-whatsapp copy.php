<?php
include './inc/db.php';
session_start();
$User_ID = $_SESSION['User_ID'];
$sql_payment_mst = "SELECT * FROM `user_details` where id='$User_ID' limit 1";
$q_payment_mst = mysqli_query($conn, $sql_payment_mst);
$row1 = mysqli_fetch_array($q_payment_mst);
$count = mysqli_num_rows($q_payment_mst);
$balance = 0;
$media_url = '';
$media_type = '';
$user_name = $row1['full_name'];
$user_emailId = $row1['email'];
$user_mobile = $row1['mobile'];
$numbercount = $_POST['numbercount'];
if ($row1['wn'] >= $numbercount) {

    $balance = $row1['wn'];
    $message =  mysqli_real_escape_string($conn, $_POST['message']);
    $api_msg = $message;
    $wimage1 = '';
    if ($_POST['radioTabTest'] == 1) {
        if ($_FILES['wimage1']['size'] > 0) {
            $media_type = "img1";
            if (isset($_FILES['wimage1']["name"])) {
                $wimage1 = $_FILES["wimage1"]["name"];
                $wimage1 = preg_replace('/\\.[^.\\s]{3,4}$/', '', $wimage1);
                $ext = pathinfo($_FILES['wimage1']['name'], PATHINFO_EXTENSION);
                $wimage1 =  time() . "_img_." . $ext;
                $wimage1_temp = $_FILES['wimage1']['tmp_name'];
                move_uploaded_file($wimage1_temp, "wimages/$wimage1");
                $media_url = "http://sendingtool.com/wimages/" . $wimage1;
                $media_name = $wimage1;
            }
            $media_url = "http://sendingtool.com/wimages/" . $wimage1;
        }
    }

    $wpdf = '';
    if ($_POST['radioTabTest'] == 2) {
        if ($_FILES['wimage2']['size'] > 0) {
            $media_type = "pdf";

            if (isset($_FILES['wimage2']["name"])) {
                $wpdf = $_FILES["wimage2"]["name"];
                $wpdf = preg_replace('/\\.[^.\\s]{3,4}$/', '', $wpdf);
                $ext = pathinfo($_FILES['wimage2']['name'], PATHINFO_EXTENSION);

                $wpdf =  time() . "_pdf_." . $ext;
                $wpdf_temp = $_FILES['wimage2']['tmp_name'];
                move_uploaded_file($wpdf_temp, "wpdf/$wpdf");
                $media_url = "http://sendingtool.com/wpdf/" . $wpdf;
                $media_name = $wpdf;
            }
            $media_url = "http://sendingtool.com/wpdf/" . $wpdf;
        }
    }


    $wvideo = '';
    if ($_POST['radioTabTest'] == 4) {
        if ($_FILES['wvideo']['size'] > 0) {
            $media_type = "video";
            if (isset($_FILES['wvideo']["name"])) {
                $wvideo = $_FILES["wvideo"]["name"];
                $wvideo = preg_replace('/\\.[^.\\s]{3,4}$/', '', $wvideo);
                $ext = pathinfo($_FILES['wvideo']['name'], PATHINFO_EXTENSION);
                $wvideo =  time() . "_video_." . $ext;
                $wvideo_temp = $_FILES['wvideo']['tmp_name'];
                move_uploaded_file($wvideo_temp, "uploads/$wvideo");
                $media_url = "http://sendingtool.com/uploads/" . $wvideo;
                $media_name = $wvideo;
            }
        }
    }




    $dpimage = '';
    if (isset($_FILES['wimage5']["name"])) {
        $dpimage = $_FILES['wimage5']['name'];
        $dpimage_temp = $_FILES['wimage5']['tmp_name'];
        move_uploaded_file($dpimage_temp, "dpimage/$dpimage");
    }

    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $today = date('Y-m-d H:i:s'); // H:i:s

    $media_message = $message;
    $query = "INSERT INTO `send_whatsapp`(`message`,`numbarCount`, `uploadImage`, `uploadPdf`, `uploadVideo`, `DPimage`, `userID`, `send_delivery_dateTime`, `status`)";
    $query .= "VALUES ('$message','$numbercount','$wimage1','$wpdf','$wvideo','$dpimage','$User_ID','$today','Process')";

    if ($conn->query($query) === TRUE) {
        $last_id = $conn->insert_id;
        $balance = $row1['wn'];
        $balance -= $numbercount;
        $query = "UPDATE `user_details` SET `wn`='$balance' WHERE `id`='$User_ID'";
        $insert_amount = mysqli_query($conn, $query);

        //Send SMS
        $api_key = '46071BEC280217';
        $contacts = '9425307833';
        $message = " Name " . $user_name . " , Email ID " . $user_emailId . " , Contact No. " . $user_mobile;
        $msg = "Dear " . $message . ", Digital Marketing service Call - 9425307833 Website - prateekiit.com PRATEEKIIT";
        $sms_text = urlencode($msg);

        $api_url = "http://sms.prateekiit.in/http-api.php?username=Prateekiit&password=12345&senderid=PRAIIT&route=06&number=" . $contacts . "&message=" . $sms_text . "&templateid=1207162885012838030";

        $response = file_get_contents($api_url);
        $contacts1 = '8085119119';
        $api_url1 = "http://sms.prateekiit.in/http-api.php?username=Prateekiit&password=12345&senderid=PRAIIT&route=06&number=" . $contacts1 . "&message=" . $sms_text . "&templateid=1207162885012838030";

        $response = file_get_contents($api_url1);
        $api_url2 = "http://sms.prateekiit.in/http-api.php?username=Prateekiit&password=12345&senderid=PRAIIT&route=06&number=7222919417&message=" . $sms_text . "&templateid=1207162885012838030";
        $response = file_get_contents($api_url2);
        $str = $_POST["mobileno"];
        $mobileno = preg_split('/\r\n|\n|\r/', $str);
        $mobile_no_count = 0;
        $msg_details_sql = "";
        foreach ($mobileno as $mobilenos) {
            $mobile_no_count++;
            $msg_details_sql .= "INSERT INTO `send_msg_details`(`send_id`, `mobNumbar`, `status`) VALUES ('$last_id','$mobilenos','Submitted');";

            if ($mobile_no_count <= 10) {

                $mob1 = $mobilenos;
                $api_msg = trim($api_msg);

                if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                    $media_type = trim($media_type);
                    $media_url = trim($media_url);
                    $send_msg_url = "http://login.bulkwhatsapp.net/wapp/api/send?apikey=975ea4c923c245eeb43a5fcc638932e2&mobile=" . $mob1 . "&msg=" . $api_msg . "&" . $media_type . "=" . $media_url;
                    $number = $mob1;
                    $msg = $api_msg;
                    $media = $media_url;
                    $ins = '6319B2E57D162';
                    $api = 'afa5c2c6d1f895f08488fb14ebf19103';
                    $url = "https://onlinepromotion.co.in/api/send.php";
                    $data = [
                        "number" => $number,
                        "type" => 'media',
                        "message" => $msg,
                        "media_url" => $media,
                        "filename" => $media_name,
                        "instance_id" => $ins,
                        "access_token" => 'afa5c2c6d1f895f08488fb14ebf19103'
                    ];
                    $whatsapp_api_url = "https://onlinepromotion.co.in/api/send.php?number=" . $number . "&type=media&message=" . $msg . "&media_url=" . $media . "&filename=" . $media_name . "&instance_id=6319B2E57D162&access_token=afa5c2c6d1f895f08488fb14ebf19103";
                    $response1 = file_get_contents($whatsapp_api_url);
                  
                    //mysqli_query($conn, "UPDATE `send_msg_details` SET `status`='Completed' WHERE `send_id`='$last_id' and `mobNumbar`='$mob1'");

                } else {
                    $number = $mob1;
                    $msg = $api_msg;
                    $ins = '6319B2E57D162';
                    $api = 'afa5c2c6d1f895f08488fb14ebf19103';
                    $url = "https://onlinepromotion.co.in/api/send.php";
                    $data = [
                        "number" => $number,
                        "type" => 'text',
                        "message" => $msg,
                        "instance_id" => $ins,
                        "access_token" => $api
                    ];

                    $whatsapp_api_url = "https://onlinepromotion.co.in/api/send.php?number=" . $number . "&type=text&message=" . $msg . "&instance_id=6319B2E57D162&access_token=afa5c2c6d1f895f08488fb14ebf19103";
                    $response1 = file_get_contents($whatsapp_api_url);
                  
                }
            }
        }
      
        if ($conn->multi_query($msg_details_sql) === TRUE) {
            // echo "New records created successfully";
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            //		die();
        }
       
        $_SESSION['count'] = $numbercount;
        echo "<script>window.location.href = 'sendwhatsapp.php?msg=1';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "<script>window.location.href = 'dashboard.php?msg=2';</script>";
}
// }
