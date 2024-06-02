<?php 
if(isset($_GET['action']) && $_GET['action']=='add'){
    include "./add-reseller.php";
}
else if(isset($_GET['action']) && $_GET['action']=='edit'){
    include "./edit-reseller.php";
}else if(isset($_GET['action']) && $_GET['action']=='credit'){
    include "./admin-reseller-credit.php";
}
else{
    include "./admin-reseller-list.php";
}

?>