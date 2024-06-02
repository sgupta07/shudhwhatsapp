<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./admin-campaign-report-view.php";
}
else{
    include "./admin-campaign-report-list.php";
}

?>