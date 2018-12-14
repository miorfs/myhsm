<?php
// include "../function/session_custom.php";
// sec_session_start(); 
session_start();
require "../models/admin.php";


if(isset($_POST["update"])){
    extract($_POST);
    
        $update = new UserManagement();
        $update -> updateSQL($name,$phone,$address,$address2,$city,$posscode,$state,$email,$password,$category);
    
}
//Otherwise do the else
else if(isset ($_POST["submit_button"])){
	
    require "../function/admin_validation.php";
    
    // extract($_POST);
    $register = new admin();
    $register -> regAdmin($name,$nickname,$email,$contact,$password,$radio);
}	
else if(isset ($_POST["update-login-btn"])){
    
    extract($_POST);
    $update = new admin();
    $update -> updateLogin($user_id,$email,$password);
}
else if(isset ($_POST["update-info-btn"])){
    
    extract($_POST);
    $update = new admin();
    $update -> updateInfo($user_id,$name,$nickname,$contact);
}
else{
$id = $_SESSION['userid'];
$viewprofile = new usermanagement();
$viewprofile->getData($id);

	include("userprofile.php");


}


?>