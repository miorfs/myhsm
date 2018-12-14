<?php

	header("Content-Type: text/html; charset=utf-8");

	// require "../config/database.php";

	if (!$_POST) exit;

/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_name	 = true;
	$validate_nickname	 = true;
	$validate_contact = true;
	$validate_ic	 = true;
	$validate_ic_db	 = false;
	$validate_radio	 = true;

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* POST data */
	$name		= (isset($_POST["name"]))		 ? strip_tags(trim($_POST["name"]))		: false;
	$nickname	= (isset($_POST["nickname"]))	 ? strip_tags(trim($_POST["nickname"]))	: false;
	$contact	= (isset($_POST["contact"]))	 ? strip_tags(trim($_POST["contact"]))	: false;
	$ic    		= (isset($_POST["ic"]))	 		 ? strip_tags(trim($_POST["ic"]))		: false;
	$radio  	= (isset($_POST["radio"]))	 	 ? strip_tags(trim($_POST["radio"]))		: false;


	$name		= htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$nickname	= htmlspecialchars($nickname, ENT_QUOTES, 'UTF-8');
	$contact	= htmlspecialchars($contact, ENT_QUOTES, 'UTF-8');
	$ic			= htmlspecialchars($ic,	 ENT_QUOTES, 'UTF-8');
	$radio	    = htmlspecialchars($radio,	 ENT_QUOTES, 'UTF-8');
	

	$name		= substr($name, 0, 100);
	$contact		= substr($contact, 0, 20);
	$ic	= substr($ic, 0, 50);



/************************************************/
/* Validation */
/************************************************/
	/* Name */
	if ($validate_name){
		$result = validateName($name, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Nickname */
	if ($validate_nickname) {
		$result = validateNickname($nickname);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Contact */
	if ($validate_contact) {
		$result = validateContact($contact, 20);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Ic */
	if ($validate_ic) {
		$result = validateIc($ic, 30);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Ic in database*/
	if ($validate_ic_db) {
		$result = validateIcDb($ic);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Radio */
	if ($validate_radio) {
		$result = validateRadio($radio, 1);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}
	

	/* If validation error occurs */
	if ($error_text) {

		$_SESSION['ERRMSG_ARR'] = $error_text;
		session_write_close();
		header("location: ../views/reg_tenant.php");
		exit();


		// foreach ($error_text as $val) {
		// 	$error_message .= '<li>' . $val . '</li>';
		// }
		// echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! The following errors occurred:<ul>' . $error_message . '</ul></div>';
		// exit;
	}


/******************************************************/
/* Validation methods */
/******************************************************/
	/* Name */
	function validateName($name, $min_length) {
		$error_text = "Oops! Looks like you put a number in a name field.";
		$name_template = '/^[A-Z a-z]*$/';
		return (preg_match($name_template, $name) !== 1) ? $error_text : "valid";//validate the string using preg match
		// $len = mb_strlen($name, 'UTF-8');
		// return ($len < $min_length) ? $error_text : "valid";
	}

	/* Nickname */
	function validateNickname($nickname) {
		$error_text = "Oops! Looks like you put a number in a nickname field.";
		$name_template = '/^[A-Z a-z]*$/';
		return (preg_match($name_template, $nickname) !== 1) ? $error_text : "valid";
		// $len = mb_strlen($name, 'UTF-8');
		// return ($len < $min_length) ? $error_text : "valid";
	}

	/* Contact */
	function validateContact($contact, $min_length) {
		$error_text = "Oops! Your phone number should not contain any character";
		return (preg_match('/^[0-9]*$/', $contact) !== 1) ? $error_text : "valid";//validate the number using preg match
		// $len = mb_strlen($pass, 'UTF-8');
		// return ($len < $min_length) ? $error_text : "valid";
	}

	/* Ic */
	function validateIc($ic, $min_length) {
		$error_text = "Oops! Ic should not contain any character";
		return (preg_match('/^[0-9]*$/', $ic) !== 1) ? $error_text : "valid";//validate the number using preg match
		// $len = mb_strlen($pass, 'UTF-8');
		// return ($len < $min_length) ? $error_text : "valid";
	}

	/* Radio */
	function validateRadio($radio, $min_length) {
		$error_text = "Please choose a gender.";
		$len = mb_strlen($radio, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}

	/* Ic in database */
	function validateIcDb($ic) {
		// require "../config/database.php";
		
		$error_text = "Oops! This is a registered identification number! Please check in the tenants list.";

		// checking ic already exists
		$sql="SELECT * FROM tenants WHERE ic='$ic' ";

		// $qry=mysql_query($sql);
		$qry = mysql_query($sql) or die($sql."<br/><br/>".mysql_error());
		// $qrys = mysql_fetch_array($qry);
		$num_rows = mysql_num_rows($qry);
		if($num_rows > 0) 
		{
			mysql_close($conn);
			return  $error_text;
		}else{
			mysql_close($conn);
			return "valid";
		}
		

		// return ($num_rows >0) ? $error_text : "valid";

		//alert if it already exists
		// if($num_rows > 0) 
		// {
		
		// }
	}

?>