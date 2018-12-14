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
	$validate_email	 = true;
	$validate_contact = true;
	$validate_password = true;
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
	$email  	= (isset($_POST["email"]))	     ? strip_tags(trim($_POST["email"]))	: false;
	$contact	= (isset($_POST["contact"]))	 ? strip_tags(trim($_POST["contact"]))	: false;
	$password	= (isset($_POST["password"]))	 ? strip_tags(trim($_POST["password"]))	: false;
	$cpassword	= (isset($_POST["cpassword"]))	 ? strip_tags(trim($_POST["cpassword"]))	: false;
	$radio  	= (isset($_POST["radio"]))	 	 ? strip_tags(trim($_POST["radio"]))		: false;


	$name		= htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	$nickname	= htmlspecialchars($nickname, ENT_QUOTES, 'UTF-8');
	$email	    = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
	$contact	= htmlspecialchars($contact, ENT_QUOTES, 'UTF-8');
	$password	= htmlspecialchars($password,	 ENT_QUOTES, 'UTF-8');
	$cpassword	= htmlspecialchars($cpassword,	 ENT_QUOTES, 'UTF-8');
	$radio	    = htmlspecialchars($radio,	 ENT_QUOTES, 'UTF-8');

/************************************************/
/* Validation */
/************************************************/
	/* Name */
	if ($validate_name){
		$result = validateName($name);
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

	/* Email */
	if ($validate_email) {
		$result = validateEmail($email);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Contact */
	if ($validate_contact) {
		$result = validateContact($contact);
		if ($result !== "valid") {
			$error_text[] = $result;
		}
	}

	/* Password */
	if ($validate_password) {
		$result = validatePassword($password,$cpassword);
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
		header("location: ../views/reg_admin.php");
		exit();

	}


/******************************************************/
/* Validation methods */
/******************************************************/
	/* Name */
	function validateName($name) {
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

	/* Email */
	function validateEmail($email) {
		$error_text = "Oops! Looks like you put a wrong email.";
		$email_template = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		return (preg_match($email_template, $email) !== 1) ? $error_text : "valid";
		// $len = mb_strlen($name, 'UTF-8');
		// return ($len < $min_length) ? $error_text : "valid";
	}

	/* Contact */
	function validateContact($contact) {
		$error_text = "Oops! Your phone number should not contain any character!";
		return (preg_match('/^[0-9]*$/', $contact) !== 1) ? $error_text : "valid";
		
	}

	/* Password */
	function validatePassword($password, $cpassword) {
		$error_text = "Oops! Your password is not same!";
		return ($password !== $cpassword) ? $error_text : "valid";
		
	}

	/* Radio */
	function validateRadio($radio, $min_length) {
		$error_text = "Please choose a role.";
		$len = mb_strlen($radio, 'UTF-8');
		return ($len < $min_length) ? $error_text : "valid";
	}


?>