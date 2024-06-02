<?php
 include "../";

class sendsms{

    function send_whatsapp_text_msg($mobile_no, $instance_id , $text_msg) {
       
$url="https://wa.ncdm.in/api/send.php?number='.$mobile_no'.&type=text&message=.'$text_msg'.&instance_id=.'$instance_id'.access_token=.'$token'.";
echo $url;
die;


$response = file_get_contents($url);


    }
    function text_msg(){
        //echo "called text_msg function";
        
    }
    function send_media_msg($mobile_no , $instance_id , $text_msg, $media_url) {
       
        echo "called send_media_msg function";
 $url="https://wa.ncdm.in/api/send.php?number=.'$mobile_no'.&type=media&message=.'$text_msg'.&media_url=.'$media_url'.&instance_id=.'$instance_id'.&access_token=.'$token'.";
 //echo $url;
//die;

 $response = file_get_contents($url);

        
    }
    function send_text_msg() {
      //  echo "called send_text_msg function";

    }
}

?>