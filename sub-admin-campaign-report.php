<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./sub-admin-campaign-report-view.php";
}
else{
    include "./sub-admin-campaign-report-list.php";
}

?>