<?php 
if(isset($_GET['action']) && $_GET['action']=='add'){
    include "./add-notes.php";
}
else{
    include "./notes-list.php";
}

?>