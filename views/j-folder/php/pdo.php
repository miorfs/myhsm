<?php

	/* Duplicate information to DB */
	function insertStudent( $studentName, $icNo, $studentPhoneNo, $studentEmail) {

		debug_to_console( "Query is being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			$mysql_table = 'student';

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (name, ic, phone_no, email)
														VALUES (:studentName, :icNo, :studentPhoneNo , :studentEmail)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":studentName", $studentName, PDO::PARAM_STR);
			$smt -> bindParam(":icNo", $icNo, PDO::PARAM_STR);
			$smt -> bindParam(":studentPhoneNo", $studentPhoneNo, PDO::PARAM_STR);
			$smt -> bindParam(":studentEmail", $studentEmail, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('student_id_seq');

			$id = "Student id is " . $row_id;
			debug_to_console( $id );

			/* Close connection */
			$pdo = null;

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
				debug_to_console( $e->getMessage() );
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;
	}


	function insertAddress($address, $postcode, $city, $state){

		debug_to_console( "Query address being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";
		$mysql_table = 'address';

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (address, city, state, postcode)
														VALUES (:address, :city, :state , :postcode)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":address", $address, PDO::PARAM_STR);
			$smt -> bindParam(":city", $city, PDO::PARAM_STR);
			$smt -> bindParam(":state", $state, PDO::PARAM_STR);
			$smt -> bindParam(":postcode", $postcode, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('address_id_seq');

			$id = "Address id is " . $row_id;
			debug_to_console( $id );

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;

	}

	function insertParent($address_id, $parentName, $parentEmail, $parentPhoneNo){

		debug_to_console( "Query parent being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";
		$mysql_table = 'parent';

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (name, email, phone_no, address_id)
														VALUES (:parentName, :parentEmail, :parentPhoneNo , :address_id)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":parentName", $parentName, PDO::PARAM_STR);
			$smt -> bindParam(":parentEmail", $parentEmail, PDO::PARAM_STR);
			$smt -> bindParam(":parentPhoneNo", $parentPhoneNo, PDO::PARAM_STR);
			$smt -> bindParam(":address_id", $address_id, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('parent_id_seq');

			$id = "Parent id is " . $row_id;
			debug_to_console( $id );

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;

	}

		function insertAcademic($student_id, $idNo, $year, $course, $faculty, $university, $gpa){

		debug_to_console( "Query academic being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";
		$mysql_table = 'academic_info';

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (student_id, matric_number, year, course, faculty, university, gpa) VALUES (:student_id, :idNo, :year , :course, :faculty, :university, :gpa)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":student_id", $student_id, PDO::PARAM_STR);
			$smt -> bindParam(":idNo", $idNo, PDO::PARAM_STR);
			$smt -> bindParam(":year", $year, PDO::PARAM_STR);
			$smt -> bindParam(":course", $course, PDO::PARAM_STR);
			$smt -> bindParam(":faculty", $faculty, PDO::PARAM_STR);
			$smt -> bindParam(":university", $university, PDO::PARAM_STR);
			$smt -> bindParam(":gpa", $gpa, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('academic_info_id_seq');

			$id = "Academic info id is " . $row_id;
			debug_to_console( $id );

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;

	}

	function insertStudentInfo($student_id, $parent_id){

		debug_to_console( "Query student info being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";
		$mysql_table = 'student_info';

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			$created_date = date("d/m/Y");

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (student_id, parent_id) VALUES (:student_id, :parent_id)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":student_id", $student_id, PDO::PARAM_STR);
			$smt -> bindParam(":parent_id", $parent_id, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('student_info_id_seq');

			$id = "Student info id is " . $row_id;
			debug_to_console( $id );

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;

	}


// lecturer side

	/* Duplicate information to DB */
	function insertLecturer($lecturerName, $icNo, $lecturerPhoneNo, $lecturerEmail, $address_id) {

		debug_to_console( "Query lecturer is being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			$mysql_table = 'lecturer';

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (name, ic, phone_no, email, address_id)
														VALUES (:lecturerName, :icNo, :lecturerPhoneNo , :lecturerEmail, :address_id)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":lecturerName", $lecturerName, PDO::PARAM_STR);
			$smt -> bindParam(":icNo", $icNo, PDO::PARAM_STR);
			$smt -> bindParam(":lecturerPhoneNo", $lecturerPhoneNo, PDO::PARAM_STR);
			$smt -> bindParam(":lecturerEmail", $lecturerEmail, PDO::PARAM_STR);
			$smt -> bindParam(":address_id", $address_id, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('lecturer_id_seq');

			$id = "Lecturer id is " . $row_id;
			debug_to_console( $id );

			/* Close connection */
			$pdo = null;

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
				debug_to_console( $e->getMessage() );
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;
	}

	/* Duplicate information to DB */
	function insertAffiliate($lecturer_id, $position, $faculty, $university, $speciality, $level, $experience) {

		debug_to_console( "Query affiliate is being executed!" );

		/* Variables */
		$error_exists = false;
		$error_pdo = "";

		try {
			/* Connection to DB */
			/* Constants, that defined in action.php, are used */
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			$mysql_table = 'affiliate_details';

			/* Query to DB */
			/* Add data to DB */
			$smt = $pdo->prepare("INSERT INTO ".$mysql_table." (lecturer_id, position, faculty, university, speciality, academic_level , experience)
														VALUES (:lecturer_id, :position, :faculty , :university, :speciality, :academic_level, :experience)");

			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
			$smt -> bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_STR);
			$smt -> bindParam(":position", $position, PDO::PARAM_STR);
			$smt -> bindParam(":faculty", $faculty, PDO::PARAM_STR);
			$smt -> bindParam(":university", $university, PDO::PARAM_STR);
			$smt -> bindParam(":speciality", $speciality, PDO::PARAM_STR);
			$smt -> bindParam(":academic_level", $level, PDO::PARAM_STR);
			$smt -> bindParam(":experience", $experience, PDO::PARAM_STR);
			$smt -> execute();

			/* Get a last row ID to send in message */
			$row_id = $pdo->lastInsertId('affiliate_details_id_seq');

			$id = "Affiliate id is " . $row_id;
			debug_to_console( $id );

			/* Close connection */
			$pdo = null;

			/* If error occurs */
			} catch (PDOException $e) {
				$error_exists = true;
				$error_pdo =  "Database error: " . $e->getMessage();
				debug_to_console( $e->getMessage() );
			}

		/* Return result */
		return $error_exists ? $error_pdo : $row_id;
	}

?>