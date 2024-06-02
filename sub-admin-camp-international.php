<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./camp-international-view.php";
}
else{
    include "./sub-admin-camp-international-list.php";
}

?>