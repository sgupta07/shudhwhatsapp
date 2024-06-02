<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./campaign-report-view.php";
}
else{
    include "./campaign-report-list.php";
}

?>