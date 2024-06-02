<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./admin-camp-button-view.php";
}
else{
    include "./admin-camp-button-list.php";
}

?>