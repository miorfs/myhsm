<?php
// include "../function/session_custom.php";
// sec_session_start();
session_start(); 
require "../models/login.php";

extract ($_POST);
 if(isset ($_POST["login"])){
	$login = new login();
	$login->validate($email, $password);
}
else{	
$logout = new login();
    $logout -> logout();
}
 
?>