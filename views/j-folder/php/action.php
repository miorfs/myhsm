<?php
	if (!isset($_SESSION)) session_start();
	header("Content-Type: text/html; charset=utf-8");

	if (!$_POST) exit;

	require dirname(__FILE__)."/validation.php";
	require dirname(__FILE__)."/csrf.php";
	require "../../../config/database.php";

	debug_to_console( "File included!" );

/************************************************/
/* Your data */
/************************************************/
	/* Your email goes here */
	$your_email = "your_email@domain.com";

	/* Your name or your company name goes here */
	$your_name = "Your name";

	/* Message subject */
	$your_subject = "J-forms: Registration form";

	/* reCaptcha secret key */
	if ($localhost){
		$secret = "6LeQgRgUAAAAAInclXXFbI3SItWv9Lz6jEoss9N3";
	}
	if ($server){
		$secret = "6LcwvBgUAAAAANcFV_40Ur9YIUhzxvQszHL8Lrdi";
	}


/************************************************/
/* Settings */
/************************************************/
	/* Select validation for fields */
	/* If you want to validate field - true, if you don't - false */
	$validate_user_name	 = false;
	$validate_email		 = false;
	$validate_pass		 = false;
	$validate_conf_pass	 = false;
	$validate_first_name = false;
	$validate_last_name	 = false;
	$validate_gender	 = false;
	$validate_captcha	 = false;

	/* Select the action */
	/* If you want to do the action - true, if you don't - false */
	$send_letter 			= false;
	$duplicate_to_database	= true;

	// define("REG_USER", "ihsm");						// your username
	// define("REG_SERVER", "localhost");						// your host
	// define("REG_PASSWORD", "ihsm");					// your password
	// define("REG_DATABASE", "ihsm");					// your database

/************************************************/
/* Variables */
/************************************************/
	/* Error variables */
	$error_text		= array();
	$error_message	= '';

	/* Last row ID */
	/* In case, if data will not be duplicated to a database */
	$row_id = "No data in a database";

	/* POST data */
	$studentName	= (isset($_POST["studentName"]))			? strip_tags(trim($_POST["studentName"]))			: false;
	$icNo		= (isset($_POST["icNo"]))				? strip_tags(trim($_POST["icNo"]))				: false;
	$studentPhoneNo		= (isset($_POST["studentPhoneNo"]))			? strip_tags(trim($_POST["studentPhoneNo"]))			: false;
	$studentEmail	= (isset($_POST["studentEmail"]))	? strip_tags(trim($_POST["studentEmail"]))	: false;
	$parentName = (isset($_POST["parentName"]))			? strip_tags(trim($_POST["parentName"]))		: false;
	$parentEmail	= (isset($_POST["parentEmail"]))			? strip_tags(trim($_POST["parentEmail"]))			: false;
	$parentPhoneNo		= (isset($_POST["parentPhoneNo"]))				? strip_tags(trim($_POST["parentPhoneNo"]))			: false;
	$address		= (isset($_POST["address"]))				? strip_tags(trim($_POST["address"]))			: false;
	$postcode		= (isset($_POST["postcode"]))				? strip_tags(trim($_POST["postcode"]))			: false;
	$city		= (isset($_POST["city"]))				? strip_tags(trim($_POST["city"]))			: false;
	$state		= (isset($_POST["state"]))				? strip_tags(trim($_POST["state"]))			: false;
	$captcha	= (isset($_POST["g-recaptcha-response"]))	? strip_tags(trim($_POST["g-recaptcha-response"]))	 : false;
	$token 		= (isset($_POST["token_register"])) 	? strip_tags(trim($_POST["token_register"]))	: false;

	$idNo		= (isset($_POST["idNo"]))				? strip_tags(trim($_POST["idNo"]))			: false;
	$year		= (isset($_POST["year"]))				? strip_tags(trim($_POST["year"]))			: false;
	$course		= (isset($_POST["course"]))				? strip_tags(trim($_POST["course"]))			: false;
	$faculty		= (isset($_POST["faculty"]))				? strip_tags(trim($_POST["faculty"]))			: false;
	$university	= (isset($_POST["university"]))	? strip_tags(trim($_POST["university"]))	 : false;
	$gpa 		= (isset($_POST["gpa"])) 	? strip_tags(trim($_POST["gpa"]))	: false;

	$studentName	= htmlspecialchars($studentName, ENT_QUOTES, 'UTF-8');
	$icNo		= htmlspecialchars($icNo, ENT_QUOTES, 'UTF-8');
	$studentPhoneNo		= htmlspecialchars($studentPhoneNo, ENT_QUOTES, 'UTF-8');
	$studentEmail	= htmlspecialchars($studentEmail, ENT_QUOTES, 'UTF-8');
	$parentName = htmlspecialchars($parentName, ENT_QUOTES, 'UTF-8');
	$parentEmail	= htmlspecialchars($parentEmail, ENT_QUOTES, 'UTF-8');
	$parentPhoneNo		= htmlspecialchars($parentPhoneNo, ENT_QUOTES, 'UTF-8');
	$token 		= htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

	// $user_name	= substr($user_name, 0, 30);
	// $email		= substr($email, 0, 30);
	// $pass		= substr($pass, 0, 30);
	// $conf_pass	= substr($conf_pass, 0, 30);
	// $first_name = substr($first_name, 0, 30);
	// $last_name	= substr($last_name, 0, 30);
	// $gender		= substr($gender, 0, 10);

/************************************************/
/* CSRF protection */
/************************************************/
	$new_token = new CSRF('register');
	if (!$new_token->check_token($token)) {
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Incorrect token. Please reload this webpage</div>';
		exit;
	}

/************************************************/
/* Validation */
/************************************************/
	/* Username */
	// if ($validate_user_name){
	// 	$result = validateUsertName($user_name, 1);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	// /* Email */
	// if ($validate_email){
	// 	$result = validateEmail($email);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	// /* Password */
	// if ($validate_pass) {
	// 	$result = validatePass($pass, 6);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	// /* Confirm password */
	// if ($validate_conf_pass) {
	// 	$result = validateConfPass($pass, $conf_pass);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	// /* First name */
	// if ($validate_first_name){
	// 	$result = validateFirstName($first_name, 1);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	// /* Last name */
	// if ($validate_last_name){
	// 	$result = validateLastName($last_name, 1);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	// /* Gender */
	// if ($validate_gender){
	// 	$result = validateGender($gender);
	// 	if ($result !== "valid") {
	// 		$error_text[] = $result;
	// 	}
	// }

	/* Captcha */
	// if ($validate_captcha) {
	// 	if ($captcha != $_SESSION['code']) {
	// 		$error_text[] = "Incorrect captcha";
	// 	}
	// }

	/* If validation error occurs */
	if ($error_text) {
		foreach ($error_text as $val) {
			$error_message .= '<li>' . $val . '</li>';
		}
		echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! The following errors occurred:<ul>' . $error_message . '</ul></div>';
		exit;
	}

/************************************************/
/* Duplicate info to a database */
/************************************************/
	if ($duplicate_to_database) {

		/* Select type of connection to a database */
		/* If you want to use connection - true, if you don't - false */
		/* For proper work you have to select only one type of connection */

		/* Mysqli connection to DB */
		$mysqli_connect = false;
		if ($mysqli_connect) {
			require dirname(__FILE__)."/mysql.php";
			$row_id = queryMysqli($mysql_table, $user_name, $email, $pass, $first_name, $last_name, $gender);
		}

		/* PDO connection to DB */
		$pdo_connect = true;
		if ($pdo_connect) {
			debug_to_console( "Pdo True" );
			require dirname(__FILE__)."/pdo.php";
			
			$student_id = insertStudent($studentName, $icNo, $studentPhoneNo, $studentEmail);
			if($student_id){
				$address_id = insertAddress( $address, $postcode, $city, $state);
			}
			if($address_id){
				$parent_id = insertParent($address_id, $parentName, $parentEmail, $parentPhoneNo);
			}
			if($parent_id){
				$academic_id = insertAcademic($student_id, $idNo, $year, $course, $faculty, $university, $gpa);
				$student_info_id = insertStudentInfo($student_id, $parent_id);
			}
			
		}
	}

/************************************************/
/* reCaptcha verification */
/************************************************/
	if ($validate_captcha) {
		require dirname(__FILE__)."/reCaptcha/autoload.php";

		// Create an instance of the service using your secret
		$re_captcha = new \ReCaptcha\ReCaptcha($secret);

		// If file_get_contents() is locked down on your PHP installation to disallow
		// its use with URLs, then you can use the alternative request method instead.
		// This makes use of fsockopen() instead.
		// $re_captcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());

		// Make the call to verify the response and also pass the user's IP address
		$valid_captcha = $re_captcha->verify($captcha, $_SERVER["REMOTE_ADDR"]);

		if (!$valid_captcha->isSuccess()) {
			echo '<div class="error-message unit"><i class="fa fa-close"></i>Oops! Are you a robot?</div>';
			exit;
		}
	}

/************************************************/
/* Sending email */
/************************************************/
	if ($send_letter) {

		/* Send email using sendmail function */
		/* If you want to use sendmail - true, if you don't - false */
		/* If you will use sendmail function - do not forget to set '$smtp' variable to 'false' */
		$sendmail = true;
		if ($sendmail) {
			require dirname(__FILE__)."/phpmailer/PHPMailerAutoload.php";
			require dirname(__FILE__)."/message.php";
			$mail = new PHPMailer;
			$mail->isSendmail();
			$mail->IsHTML(true);
			$mail->From = $email;
			$mail->CharSet = "UTF-8";
			$mail->FromName = "J-forms";
			$mail->Encoding = "base64";
			$mail->ContentType = "text/html";
			$mail->addAddress($your_email, $your_name);
			$mail->Subject = $your_subject;
			$mail->Body = $letter;
			$mail->AltBody = "Use an HTML compatible email client";
		}

		/* Send email using smtp function */
		/* If you want to use smtp - true, if you don't - false */
		/* If you will use smtp function - do not forget to set '$sendmail' variable to 'false' */
		$smtp = false;
		if ($smtp) {
			require dirname(__FILE__)."/phpmailer/PHPMailerAutoload.php";
			require dirname(__FILE__)."/message.php";
			$mail = new PHPMailer;
			$mail->isSMTP();											// Set mailer to use SMTP
			$mail->Host = "smtp1.example.com;smtp2.example.com";		// Specify main and backup server
			$mail->SMTPAuth = true;										// Enable SMTP authentication
			$mail->Username = "your-username";							// SMTP username
			$mail->Password = "your-password";							// SMTP password
			$mail->SMTPSecure = "tls";									// Enable encryption, 'ssl' also accepted
			$mail->Port = 465;											// SMTP Port number e.g. smtp.gmail.com uses port 465
			$mail->IsHTML(true);
			$mail->From = $email;
			$mail->CharSet = "UTF-8";
			$mail->FromName = "J-forms";
			$mail->Encoding = "base64";
			$mail->Timeout = 200;
			$mail->SMTPDebug = 0;
			$mail->ContentType = "text/html";
			$mail->addAddress($your_email, $your_name);
			$mail->Subject = $your_subject;
			$mail->Body = $letter;
			$mail->AltBody = "Use an HTML compatible email client";
		}

		/* Multiple email recepients */
		/* If you want to add multiple email recepients - true, if you don't - false */
		/* Enter email and name of the recipients */
		$recipients = false;
		if ($recipients) {
			$recipients = array("email@domain.com" => "name of recipient",
								"email@domain.com" => "name of recipient",
								"email@domain.com" => "name of recipient"
								);
			foreach ($recipients as $email => $name) {
				$mail->AddBCC($email, $name);
			}
		}

		/* if error occurs while email sending */
		if(!$mail->send()) {
			echo '<div class="error-message unit"><i class="fa fa-close"></i>Mailer Error: ' . $mail->ErrorInfo . '</div>';
			exit;
		}
	}

/************************************************/
/* Success message */
/************************************************/
	echo '<div class="success-message unit"><i class="fa fa-check"></i>Your message has been sent</div>';
	echo "<script type='text/javascript'>location.href ='../index.php'</script>";
?>