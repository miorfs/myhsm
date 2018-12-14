<?php
// include "../function/session_custom.php";
// sec_session_start(); 
session_start();
require "../models/tenant.php";


if(isset($_POST["approval_form"])){
    extract($_POST);
    $update_approval = new tenant();
    $update_approval -> updateApproval($user_id,$approval_form);
    
}
//Otherwise do the else
else if(isset ($_POST["submit_button"])){
	
    require "../function/validation.php";
    
    // extract($_POST);
    $register = new tenant();
    $register -> regTenant($name,$nickname,$contact,$ic,$radio);
}	
else if(isset ($_POST["update-btn-setting"])){
    
    extract($_POST);
    $update_tenant = new tenant();
    $update_tenant -> updateTenant($user_id,$name,$nickname,$ic,$contact);
}
else if(isset ($_POST["save-address-btn"])){
    
    extract($_POST);
    $register = new tenant();
    $register -> saveAddress($user_id,$address,$city,$state,$postcode);
}
else if(isset ($_POST["update-address-btn"])){
    
    extract($_POST);
    $update_address = new tenant();
    $update_address -> updateAddress($aid,$user_id,$address,$city,$state,$postcode);
}
else if(isset ($_POST["esave-contact-btn"])){
    
    extract($_POST);
    $register = new tenant();
    $register -> saveEcontact($user_id,$ename,$econtact,$erelation);
}
else if(isset ($_POST["eupdate-contact-btn"])){
    
    extract($_POST);
    $update_econtact = new tenant();
    $update_econtact -> updateEcontact($eid,$user_id,$ename,$econtact,$erelation);
}
else if(isset ($_POST["save-rental-info-btn"])){
    
    extract($_POST);
    $register = new tenant();
    $register -> saveTenantsRentalInfo($user_id,$contract,$deposit,$utility,$mrent,$room_id);
}
else if(isset ($_POST["update-rental-info-btn"])){
    
    extract($_POST);
    $update_econtact = new tenant();
    $update_econtact -> updateTenantsRentalInfo($tri_id,$user_id,$contract,$deposit,$utility,$mrent,$room_id);
}
else{
$id = $_SESSION['userid'];
$viewprofile = new usermanagement();
$viewprofile->getData($id);

	include("userprofile.php");


}


?>