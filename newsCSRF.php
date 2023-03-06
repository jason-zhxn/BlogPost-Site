<?php
//csrf token checking file
if(!isset($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
}

?>