<?php
if ($_POST['message'] == '') {
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
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $api_msg = $message;
    $media_name = '';
    $media_type = '';
    $campaignName = '';

    // Handle file uploads
    if ($_POST['radioTabTest'] == 1 && $_FILES['wimage1']['size'] > 0) {
        $media_type = "img1";
        $campaignName = 'ImageCampaign';
        $wimage1 = time() . "_img_." . pathinfo($_FILES['wimage1']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['wimage1']['tmp_name'], "wimages/$wimage1");
        $media_url = "https://shudhwhatsapp.in/wimages/$wimage1";
        $media_name = $wimage1;
    }

    if ($_POST['radioTabTest'] == 2 && $_FILES['wimage2']['size'] > 0) {
        $media_type = "pdf";
        $campaignName = 'PdfCampaign';
        $wpdf = time() . "_pdf_." . pathinfo($_FILES['wimage2']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['wimage2']['tmp_name'], "wpdf/$wpdf");
        $media_url = "https://shudhwhatsapp.in/wpdf/$wpdf";
        $media_name = $wpdf;
    }

    if ($_POST['radioTabTest'] == 4 && $_FILES['wvideo']['size'] > 0) {
        $media_type = "video";
        $campaignName = 'VideoCampaign';
        $wvideo = time() . "_video_." . pathinfo($_FILES['wvideo']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['wvideo']['tmp_name'], "wvideos/$wvideo");
        $media_url = "https://shudhwhatsapp.in/wvideos/$wvideo";
        $media_name = $wvideo;
    }

    $dpimage = '';
    if (isset($_FILES['wimage5']["name"])) {
        $dpimage = $_FILES['wimage5']['name'];
        move_uploaded_file($_FILES['wimage5']['tmp_name'], "dpimage/$dpimage");
    }

    date_default_timezone_set("Asia/Calcutta");   // India time (GMT+5:30)
    $today = date('Y-m-d H:i:s'); // H:i:s

    $media_message = $message;
    $query = "INSERT INTO `b_send_whatsapp`(`message`,`numbarCount`, `uploadImage`, `uploadPdf`, `uploadVideo`, `DPimage`, `userID`, `visit_now`, `call_now`, `send_delivery_dateTime`, `status`)";
    $query .= "VALUES ('$message','$numbercount','$wimage1','$wpdf','$wvideo','$dpimage','$User_ID','$btn_link','$btn_call','$today','Process')";

    if ($conn->query($query) === TRUE) {
        $last_id = $conn->insert_id;
        $balance -= $numbercount;
        $query = "UPDATE `user_details` SET `wb`='$balance' WHERE `id`='$User_ID'";
        $insert_amount = mysqli_query($conn, $query);

        // Start: Notify about new request
        $message = "Schedule WhatsApp SMS Request with File from User ID ".$user_mobile." Unique ID ".$last_id." with credits ".$numbercount." created on ".date("d-m-Y")." Team NCDM";
        $api_url = "http://shudhsms.in/sendsms.php?username=ncdmal&password=123456&sender=NCDMAL&mobile=7465988888&message=".$message."&route=T&entity_id=1401404270000020916&content_id=1407170505191537440";
        file_get_contents($api_url);
        $api_url = "http://shudhsms.in/sendsms.php?username=ncdmal&password=123456&sender=NCDMAL&mobile=7425930555&message=".$message."&route=T&entity_id=1401404270000020916&content_id=1407170505191537440";
        file_get_contents($api_url);
        $api_url = "http://shudhsms.in/sendsms.php?username=ncdmal&password=123456&sender=NCDMAL&mobile=7425946555&message=".$message."&route=T&entity_id=1401404270000020916&content_id=1407170505191537440";
        file_get_contents($api_url);
        $api_url = "http://shudhsms.in/sendsms.php?username=ncdmal&password=123456&sender=NCDMAL&mobile=9251627812&message=".$message."&route=T&entity_id=1401404270000020916&content_id=1407170505191537440";
        file_get_contents($api_url);
        // End

        // Prepare numbers
        $str = $_POST["mobileno"];
        $mobileno = preg_split('/\r\n|\n|\r/', $str);

        // Function to send WhatsApp message via AiSensy API
        function sendWhatsAppMessage($apiKey, $campaignName, $destination, $userName, $message, $media_url = null) {
            $url = "https://backend.aisensy.com/campaign/t1/api/v2";
            $data = [
                "apiKey" => $apiKey,
                "campaignName" => $campaignName,
                "destination" => $destination,
                "userName" => $userName,
                "templateParams" => [$message],
                "tags" => [],
                "attributes" => []
            ];
            if ($media_url) {
                $data["media"] = [
                    "url" => $media_url,
                    "filename" => basename($media_url)
                ];
            }
            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data)
                ]
            ];
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            return $result !== FALSE ? json_decode($result, true) : false;
        }

        // Send messages
        foreach ($mobileno as $destination) {
            $response = sendWhatsAppMessage('your_api_key_here', $campaignName, $destination, $user_name, $message, $media_url);
            if (!$response) {
                echo "Error sending message to $destination";
            }
        }

        // Log message details
        $msg_details_sql = "";
        foreach ($mobileno as $mobilenos) {
            $msg_details_sql .= "INSERT INTO `b_send_msg_details`(`send_id`, `mobNumbar`, `status`) VALUES ('$last_id','$mobilenos','Submitted');";
        }
        if ($conn->multi_query($msg_details_sql) === TRUE) {
            // Records created successfully
        } else {
            // Error: Log error
        }

        $_SESSION['count'] = $numbercount;
        echo "<script>window.location.href = 'send-button.php?msg=1';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "<script>window.location.href = 'dashboard.php?msg=2';</script>";
}
?>
