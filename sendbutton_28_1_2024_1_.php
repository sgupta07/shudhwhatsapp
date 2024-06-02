<?php
if($_POST['message'] ==''){
   // echo "<script>window.location.href = 'send-button.php?msg=2';</script>";  
    header("location:send-button.php?msg=2");
    die();
}
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
$btn_call = $_POST['btn_call'];
$btn_link = $_POST['btn_link'];
if ($row1['wb'] >= $numbercount) {

    $balance = $row1['wb'];
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
                $media_url = "https://shudhwhatsapp.in/wimages/" . $wimage1;
                $media_name = $wimage1;
            }
            $media_url = "https://shudhwhatsapp.in/wimages/" . $wimage1;
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
                $media_url = "https://shudhwhatsapp.in/wpdf/" . $wpdf;
                $media_name = $wpdf;
            }
            $media_url = "https://shudhwhatsapp.in/wpdf/" . $wpdf;
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
                move_uploaded_file($wvideo_temp, "wvideos/$wvideo");
                $media_url = "https://shudhwhatsapp.in/wvideos/" . $wvideo;
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
    $query = "INSERT INTO `b_send_whatsapp`(`message`,`numbarCount`, `uploadImage`, `uploadPdf`, `uploadVideo`, `DPimage`, `userID`, `visit_now`, `call_now`, `send_delivery_dateTime`, `status`)";
    $query .= "VALUES ('$message','$numbercount','$wimage1','$wpdf','$wvideo','$dpimage','$User_ID','$btn_link','$btn_call','$today','Process')";

    if ($conn->query($query) === TRUE) {
        $last_id = $conn->insert_id;
        $balance = $row1['wb'];
        $balance -= $numbercount;
        $query = "UPDATE `user_details` SET `wb`='$balance' WHERE `id`='$User_ID'";
        $insert_amount = mysqli_query($conn, $query);

        //Send SMS
        $api_key = '46071BEC280217';
        $contacts = '9425307833';
        $message = " Name " . $user_name . " , Email ID " . $user_emailId . " , Contact No. " . $user_mobile;
        $msg = "Dear " . $message . ", Digital Marketing service Call - 9425307833 Website - prateekiit.com PRATEEKIIT";
        // $sms_text = urlencode($msg);

         $api_url = "http://sms.prateekiit.in/http-api.php?username=Prateekiit&password=12345&senderid=PRAIIT&route=06&number=" . $contacts . "&message=" . $sms_text . "&templateid=1207162885012838030";

        //  $response = file_get_contents($api_url);
        
        $contacts1 = '8085119119';
         $api_url1 = "http://sms.prateekiit.in/http-api.php?username=Prateekiit&password=12345&senderid=PRAIIT&route=06&number=" . $contacts1 . "&message=" . $sms_text . "&templateid=1207162885012838030";

        //  $response = file_get_contents($api_url1);
        
        
        
      
        
        
        $str = $_POST["mobileno"];
        $mobileno = preg_split('/\r\n|\n|\r/', $str);
        $mobile_no_count = 0;
        $msg_details_sql = "";
        foreach ($mobileno as $mobilenos) {
            $mobile_no_count++;
            $msg_details_sql .= "INSERT INTO `b_send_msg_details`(`send_id`, `mobNumbar`, `status`) VALUES ('$last_id','$mobilenos','Submitted');";

                if (count($mobileno) <= 10) {
                if ($numbercount <= 5) {
                    if ($mobile_no_count == 1) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "Z1E2KV9wrDSjGUt";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                               "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];

                                //"urlbtntext" => "Visit Now",
                                
                                //  "callbtn" => $btn_call,
                                // "callbtntext" => "Call Now",
                                // "urlbtn" => $btn_link,
                                // "urlbtntext" => "Visit Now",

                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "Z1E2KV9wrDSjGUt";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "Z1E2KV9wrDSjGUt";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count == 2) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "PcZm3jIeS59aLFN";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "PcZm3jIeS59aLFN";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "PcZm3jIeS59aLFN";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count == 3) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "hQtlVEuHongjrR2";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                 "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "hQtlVEuHongjrR2";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "hQtlVEuHongjrR2";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count == 4) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "vjYL8hkJ0Z4xXRc";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "vjYL8hkJ0Z4xXRc";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "vjYL8hkJ0Z4xXRc";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count == 5) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "gXpIJnots6ErZu5";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                               "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "gXpIJnots6ErZu5";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "gXpIJnots6ErZu5";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    }
                } else {
                    if ($mobile_no_count <= 2) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "Z1E2KV9wrDSjGUt";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                               "btn1"=>$btn_call,
                               "btn2"=>$btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];

//  "callbtn" => $btn_call,
                                // "callbtntext" => "Call Now",
                                // "urlbtn" => $btn_link,
                                // "urlbtntext" => "Visit Now",
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "Z1E2KV9wrDSjGUt";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "Z1E2KV9wrDSjGUt";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count <= 4) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "PcZm3jIeS59aLFN";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                               "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "PcZm3jIeS59aLFN";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "PcZm3jIeS59aLFN";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count <= 6) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "hQtlVEuHongjrR2";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                               "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "hQtlVEuHongjrR2";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "hQtlVEuHongjrR2";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count <= 8) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "vjYL8hkJ0Z4xXRc";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "vjYL8hkJ0Z4xXRc";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "vjYL8hkJ0Z4xXRc";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    } else if ($mobile_no_count <= 10) {
                        $mob1 = $mobilenos;
                        $api_msg = trim($api_msg);

                        if ($btn_call != "" || $btn_link != "") {


                            $number = $mob1;
                            $api_msg = strip_tags($api_msg);
                            $msg = html_entity_decode($api_msg);
                            $media = trim($media_url);
                            $ins = "gXpIJnots6ErZu5";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-quick-button.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "btn1" => $btn_call,
                                "btn2" => $btn_link,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else if ($media_type == "pdf" || $media_type == "img1" || $media_type == "video") {
                            $number = $mob1;

                            $api_msg = strip_tags($api_msg);

                            $msg = html_entity_decode($api_msg);

                            $media = trim($media_url);
                            $ins = "gXpIJnots6ErZu5";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";



                            $url = "https://app.whatzapi.com/api/send-media.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "media" => $media,
                                "instance" => $ins,
                                "apikey" => $api
                            ];


                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        } else {

                            $number = $mob1;
                            $msg = $api_msg;
                            $ins = "gXpIJnots6ErZu5";
                            $api = "05c553482176a93f10b9da78ed015c7793d7da21";
                            $url = "https://app.whatzapi.com/api/send-text.php";
                            $data = [
                                "number" => $number,
                                "msg" => $msg,
                                "instance" => $ins,
                                "apikey" => $api
                            ];
                            // $ch = curl_init();
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // $result = curl_exec($ch);
                            // curl_close($ch);
                            // $result;
                        }
                    }
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
        echo "<script>window.location.href = 'send-button.php?msg=1';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "<script>window.location.href = 'dashboard.php?msg=2';</script>";
}
// }
