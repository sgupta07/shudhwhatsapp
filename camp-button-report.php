<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./camp-button-view.php";
}
else{
    include "./camp-button-list.php";
}

?>