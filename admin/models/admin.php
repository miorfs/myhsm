 <?php
 /*************************************************
 This class can update user profile, view user profile and register new user
 **************************************************/
  class admin{
	        	        
	public $id;
	public $name;
	public $nickname;
	public $phone;
	public $ic;
	public $address;
	public $address2;
	public $city;
	public $posscode;
	public $state;
	public $email;
	public $password;
	public $role;
	public $category;
	
	public function __construct()
	{
					
	}
	
   public function setUserId($id){$this->id = $id;}
   public function getUserId(){return $this->id;}
   
   public function setName($name){$this->name = $name;}
   public function getName(){return $this->name;}

   public function setNickname($nickname){$this->nickname = $nickname;}
   public function getNickname(){return $this->nickname;}
   
   public function setPhone($phone){$this->phone = $phone;}
   public function getPhone(){return $this->phone;}

   public function setIc($ic){$this->ic = $ic;}
   public function getIc(){return $this->ic;}
   
   public function setAddress($address){$this->address = $address;}
   public function getAddress(){return $this->address;}
   
   public function setAddress2($address2){$this->address2 = $address2;}
   public function getAddress2(){return $this->address2;}
   
   public function setCity($address){$this->city = $city;}
   public function getCity(){return $this->city;}
   
   public function setPosscode($posscode){$this->posscode = $posscode;}
   public function getPosscode(){return $this->posscode;}
   
   public function setState($state){$this->state = $state;}
   public function getState(){return $this->state;}
   
   public function setEmail($email){$this->email = $email;}
   public function getEmail(){return $this->email;}
   
   public function setPassword($password){$this->password = $password;}
   public function getPassword(){return $this->password;}

   public function setRole($role){$this->role = $role;}
   public function getRole(){return $this->role;}
   
   public function setCategory($category){$this->category = $category;}
   public function getCategory(){return $this->category;}

   
   
   public function regAdmin($name,$nickname,$email,$contact,$password,$radio)
   {
		require "../config/database.php";
		
		$this->name = $name; 
		$this->nickname = $nickname;
		$this->email = $email;  
		$this->phone = $contact;
		$this->password = $password;
		$this->role = $radio;

		//set to become true for email validation
		$validate_email_db	 = true;
		//set to become true for nickname validation
		$validate_nickname_db	 = true;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';

		/* Check email in database*/
		if ($validate_email_db) {
			$result = $this->validateEmailDb($email, $conn);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}
		/* Check nickname in database*/
		if ($validate_nickname_db) {
			$result = $this->validateNicknameDb($nickname, $conn);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

		/* If validation error occurs */
		if ($error_text) {

			$_SESSION['ERRMSG_ARR'] = $error_text;
			session_write_close();
			echo("<script>location.href = '../views/reg_admin.php';</script>");
			// header("location: ../views/reg_admin.php");
			exit();
		}

		/* Your database table goes here */
		$mysql_table = "admin";
		$query="INSERT INTO ".$mysql_table."(id,name,email,password,contact,role,nickname) 
			VALUES (NULL,'$this->name','$this->email','$this->password','$this->phone','$this->role','$this->nickname')";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		if ($result) {
			$query_number="SELECT id FROM admin";
			$result_query = mysqli_query($conn,$query_number);
			$number = mysqli_num_rows($result_query);
			$query_update = "UPDATE row_count SET total_admin='$number' WHERE id=1";
			$result_update = mysqli_query($conn,$query_update);

		    $success_text = array();
			$success_msg = "Your data has been successfully saved!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/reg_admin.php';</script>");
				// header("location: ../views/reg_admin.php");
				exit();
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$this->setName($this->name);
		$this->setNickname($this->nickname);
		$this->setPhone($this->phone);
		$this->setEmail($this->email);
		$this->setPassword($this->password);
		$this->setRole($this->role);

		mysqli_close($conn);
		
   }

   /* Email in database */
	public function validateEmailDb($email, $conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! This is a registered email! Please check in the admin list.";

		/* Your database table goes here */
		$mysql_table = "admin";

		/* Query to DB */
		$query = "SELECT email FROM ".$mysql_table." WHERE email = '$email' ";
		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($conn);
		}

		if (mysqli_num_rows($result) > 0) {
		    return $error_text;
		}else{
			return "valid";
		}
	}

	/* Nickname in database */
	public function validateNicknameDb($nickname, $conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! Nickname already used!";

		/* Your database table goes here */
		$mysql_table = "admin";

		/* Query to DB */
		$query = "SELECT nickname FROM ".$mysql_table." WHERE nickname = '$nickname' ";
		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($conn);
		}

		if (mysqli_num_rows($result) > 0) {
		    return $error_text;
		}else{
			return "valid";
		}
	}

	public function getAdminProfile($user_id){

		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "admin";

		/* Query to DB */
		$query = "SELECT * FROM ". $mysql_table." WHERE id='$user_id'";
		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($conn);
		}

		if (mysqli_num_rows($result) > 0) {
			//require "../views/user_list.php";
		    // include("../views/user_list.php");
		    return $result;
		}else{
			return $error_text;
		}
	}

	// update login in database
	public function updateLogin($user_id,$email,$password)
   {
		require "../config/database.php";
		
		$this->email = $email;  
		$this->password = $password;
		

		    /* Your database table goes here */
			$mysql_table = "admin";
			$query="UPDATE ".$mysql_table." SET email='$this->email', password='$this->password' WHERE id='$user_id'";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			/* Get a last row ID to send in message */
			$row_id = mysqli_insert_id($conn);

			if ($result) {
			    $success_text		= array();
				$success_msg = "Your data has been successfully updated!";
				$success_text[] = $success_msg;
				if ($success_text) {
					$_SESSION['SUCCESS_MSG'] = $success_text;
					session_write_close();
					echo("<script>location.href = '../views/admin_profile.php?user_id=$user_id';</script>");
					// header("location: ../views/admin_profile.php?user_id=$user_id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }

   // update info in database
	public function updateInfo($user_id,$name,$nickname,$contact)
   {
		require "../config/database.php";
		
		$this->name = $name; 
		$this->nickname = $nickname;  
		$this->phone = $contact;
		

		    /* Your database table goes here */
			$mysql_table = "admin";
			$query="UPDATE ".$mysql_table." SET name='$this->name', contact='$this->phone', nickname='$this->nickname' WHERE id='$user_id'";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			/* Get a last row ID to send in message */
			$row_id = mysqli_insert_id($conn);

			if ($result) {
			    $success_text		= array();
				$success_msg = "Your data has been successfully updated!";
				$success_text[] = $success_msg;
				if ($success_text) {
					$_SESSION['SUCCESS_MSG'] = $success_text;
					session_write_close();
					echo("<script>location.href = '../views/admin_profile.php?user_id=$user_id';</script>");
					// header("location: ../views/admin_profile.php?user_id=$user_id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }


	
}

	

?>