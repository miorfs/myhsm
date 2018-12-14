<?php 

// 	require "../config/database.php";
// 	// require "../config/debug.php";
// $studentName = "mior";
// $icNo = "939393";
//  $studentPhoneNo = "432243";
//  $studentEmail = "mior@yahoo.com";

// debug_to_console( "Query is being executed!" );

// 		/* Variables */
// 		$error_exists = false;
// 		$error_pdo = "";

// 		try {
// 			/* Connection to DB */
// 			/* Constants, that defined in action.php, are used */
// 			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

// 			$created_date = date("d-m-Y");
// 			// echo $created_date;

// 			$mysql_table = 'student';

// 			/* Query to DB */
// 			/* Add data to DB */
// 			$smt = $pdo->prepare("INSERT INTO student (name, ic, phone_no, email)
// 														VALUES (:studentName, :icNo, :studentPhoneNo , :studentEmail)");


// 			// $smt -> bindParam(":id", NULL , PDO::PARAM_STR);
// 			$smt -> bindParam(":studentName", $studentName, PDO::PARAM_STR);
// 			$smt -> bindParam(":icNo", $icNo, PDO::PARAM_STR);
// 			$smt -> bindParam(":studentPhoneNo", $studentPhoneNo, PDO::PARAM_STR);
// 			$smt -> bindParam(":studentEmail", $studentEmail, PDO::PARAM_STR);
// 			// $smt -> execute();

// 			if($smt -> execute()){
// 			    echo 'Row inserted!<br>';
// 			}

// 			/* Get a last row ID to send in message */
// 			$row_id = $pdo->lastInsertId('student_id_seq');

// 			$id = "Student id is " . $row_id;
// 			debug_to_console( $id );

// 			/* Close connection */
// 			$pdo = null;

// 			/* If error occurs */
// 			} catch (PDOException $e) {
// 				$error_exists = true;
// 				$error_pdo =  "Database error: " . $e->getMessage();
// 			}



// $dbuser = 'ihsm';
// $password = 'ihsm';

// // Replace the database connection information, username and password with your own.
// $conn = new PDO('pgsql:dbname=ihsm;host=localhost;dbname=ihsm', $dbuser, $password);

// $conn->exec('CREATE TABLE testIncrement ' .
//             '(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50))');
// $sth = $conn->prepare('INSERT INTO testIncrement (name) VALUES (:name)');
// $sth->execute([':name' => 'foo']);
// var_dump($conn->lastInsertId("testIncrement_id_seq"));
// $conn->exec('DROP TABLE testIncrement');



// $dbuser = 'ihsm';
// $password = 'ihsm';

// 		try {
// 			/* Connection to DB */
// 			/* Constants, that defined in action.php, are used */
// 			$pdo = new PDO("pgsql:host=localhost;dbname=ihsm", $dbuser, $password);

// 			$sqli = "INSERT INTO student(
//             name) VALUES (
            
//             :student_name)";
                                          
// 			$stmt = $pdo->prepare($sqli);

// 			$name = 'farhansyukri';
			                                                  
// 			$stmt->bindParam(':student_name', $name , PDO::PARAM_STR);   
			                                      
// 			$insert = $stmt->execute();

// 			if($insert){
// 			    echo 'Row inserted!<br>';
// 			}

// 			/* Query to DB */
// 			$sql = "SELECT * FROM student";
// 			foreach($pdo->query($sql) as $row){
// 				echo $row['id'], ' : ', $row['name'], '<br>';
// 			}

// 			/* Close connection */
// 			$pdo = null;

// 			/* If error occurs */
// 			} catch (PDOException $e) {
// 				echo "Error : ", $e->getMessage(), '<br>';
// 			}
?>