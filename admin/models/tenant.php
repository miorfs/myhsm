 <?php
 /*************************************************
 This class can update user profile, view user profile and register new user
 **************************************************/
  class tenant{
	        	        
	public $id;
	public $name;
	public $phone;
	public $nickname;
	public $ic;
	public $gender;
	public $address;
	public $address2;
	public $city;
	public $posscode;
	public $postcode;
	public $state;
	public $email;
	public $password;
	public $category;

	public $ename;
	public $econtact;
	public $eaddress;
	
	public $contract;
	public $deposit;
	public $utility;
	public $mrent;
	public $room_id;


	public function __construct()
	{
					
	}
	
   public function setUserId($id){$this->id = $id;}
   public function getUserId(){return $this->id;}
   
   public function setName($name){$this->name = $name;}
   public function getName(){return $this->name;}
   
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
   
   public function setPostcode($postcode){$this->postcode = $postcode;}
   public function getPostcode(){return $this->postcode;}
   
   public function setState($state){$this->state = $state;}
   public function getState(){return $this->state;}
   
   public function setEmail($email){$this->email = $email;}
   public function getEmail(){return $this->email;}
   
   public function setPassword($password){$this->password = $password;}
   public function getPassword(){return $this->password;}
   
   public function setCategory($category){$this->category = $category;}
   public function getCategory(){return $this->category;}

   public function setGender($gender){$this->gender = $gender;}
   public function getGender(){return $this->gender;}

   public function setNickname($nickname){$this->nickname = $nickname;}
   public function getNickname(){return $this->nickname;}

   public function setEname($ename){$this->ename = $ename;}
   public function getEname(){return $this->ename;}

   public function setEcontact($econtact){$this->econtact = $econtact;}
   public function getEcontact(){return $this->econtact;}

   public function setErelation($erelation){$this->erelation = $erelation;}
   public function getErelation(){return $this->erelation;}

   
   
   public function regTenant($name,$nickname,$phone,$ic,$radio)
   {
		require "../config/database.php";
		
		$this->name = $name; 
		$this->phone = $phone;
		$this->nickname = $nickname;
		$this->ic = $ic;
		$this->gender = $radio;

		//set to become true for ic validation
		$validate_ic_db	 = true;
		//set to become true for nickname validation
		$validate_nickname_db	 = true;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';

		/* Check Ic in database*/
		if ($validate_ic_db) {
			$result = $this->validateIcDb($ic, $conn);
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
			echo("<script>location.href = '../views/reg_tenant.php';</script>");
			// header("location: ../views/reg_tenant.php");
			exit();
		}

		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		$created_date = date("d/m/Y");
		$ids = $_SESSION['userid'];


		/* Your database table goes here */
		$mysql_table = "tenants";
		$query="INSERT INTO ".$mysql_table."(id,name,ic,contact,gender,status,created_by,created_date,nickname) 
			VALUES (NULL,'$this->name','$this->ic','$this->phone', '$this->gender', '$status','$ids','$created_date','$this->nickname' )";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		if ($result) {
			$query_number="SELECT id FROM tenants";
			$result_query = mysqli_query($conn,$query_number);
			$number = mysqli_num_rows($result_query);
			$query_update = "UPDATE row_count SET total_tenants='$number' WHERE id=1";
			$result_update = mysqli_query($conn,$query_update);

		    $success_text		= array();
			$success_msg = "Your data has been successfully saved!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/reg_tenant.php';</script>");
				// header("location: ../views/reg_tenant.php");
				exit();
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$this->setIc($this->ic);
		$this->setName($this->name);
		$this->setPhone($this->phone);

		mysqli_close($conn);
		
		
   }

   // update tenant info contact in database
	public function updateTenant($user_id,$name,$nickname,$ic,$contact)
   {
		require "../config/database.php";
		
		$this->id = $user_id;
		$this->name = $name; 
		$this->ic = $ic;
		$this->phone = $contact;
		$this->nickname = $nickname;
		
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		    /* Your database table goes here */
			$mysql_table = "tenants";
			$query="UPDATE ".$mysql_table." SET name='$this->name', ic='$this->ic', contact='$this->phone', nickname='$this->nickname' WHERE id='$user_id'";

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
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$this->id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }

   // update approval in database
	public function updateApproval($user_id,$approval_form)
   {
		require "../config/database.php";
		
		$this->id = $user_id;
		
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		    /* Your database table goes here */
			$mysql_table = "tenants";
			$query="UPDATE ".$mysql_table." SET status='$approval_form' WHERE id='$user_id'";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			if ($result) {
			    $success_text		= array();
				$success_msg = "Your data has been successfully updated!";
				$success_text[] = $success_msg;
				if ($success_text) {
					$_SESSION['SUCCESS_MSG'] = $success_text;
					session_write_close();
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$this->id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }

   /* Ic in database */
	public function validateIcDb($ic, $conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! This is a registered identification number! Please check in the tenants list.";

		/* Your database table goes here */
		$mysql_table = "tenants";

		/* Query to DB */
		$query = "SELECT ic FROM ".$mysql_table." WHERE ic = '$ic' ";
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
		
		$error_text = "Oops! Nickname already used! Select different nickname.";

		/* Your database table goes here */
		$mysql_table = "tenants";

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

	// save address in database
	public function saveAddress($id,$address,$city,$state,$postcode)
   {
		require "../config/database.php";
		
		$this->id = $id;
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->postcode = $postcode;
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		$created_date = date("d/m/Y");
		$id_admin = $_SESSION['userid'];

		$sql = "SELECT id FROM admin Where id = '$id_admin'";
		$results = mysqli_query($conn, $sql);

		if (mysqli_num_rows($results) > 0) {
		    while($row = mysqli_fetch_assoc($results)) {
		        $ids = $row["id"];
		    }
		}

		$query_tenants = "SELECT id FROM tenants Where id = '$id'";
		$results_tenants = mysqli_query($conn, $query_tenants);

		if (mysqli_num_rows($results_tenants) > 0) {
		    while($row_tenants = mysqli_fetch_assoc($results_tenants)) {
		        $id_tenants = $row_tenants["id"];
		    }

		    /* Your database table goes here */
			$mysql_table = "tenants_address";
			$query="INSERT INTO ".$mysql_table."(id,address,state,city,postcode,tenants_id,created_date,created_by) 
				VALUES (NULL,'$this->address','$this->state','$this->city', '$this->postcode', '$id_tenants','$created_date','$ids' )";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			/* Get a last row ID to send in message */
			$row_id = mysqli_insert_id($conn);

			if ($result) {
		    $success_text		= array();
			$success_msg = "Your data has been successfully saved!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
				// header("location: ../views/user_profile.php?user_id=$this->id");
				exit();
			}
			} else {
			    echo "Error in save address: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}

		

		
		
		
   }
   
  	 // update address contact in database
	public function updateAddress($aid,$user_id,$address,$city,$state,$postcode)
   {
		require "../config/database.php";
		
		$this->id = $user_id;
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->postcode = $postcode;
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		    /* Your database table goes here */
			$mysql_table = "tenants_address";
			$query="UPDATE ".$mysql_table." SET address='$this->address', state='$this->state', city='$this->city', postcode='$this->postcode' WHERE id='$aid'";

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
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$this->id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }


	// save emergency contact in database
	public function saveEcontact($id,$ename,$econtact,$erelation)
   {
		require "../config/database.php";
		
		$this->id = $id;
		$this->ename = $ename;
		$this->econtact = $econtact;
		$this->erelation = $erelation;
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		$created_date = date("d/m/Y");
		$id_admin = $_SESSION['userid'];

		$sql = "SELECT id FROM admin Where id = '$id_admin'";
		$results = mysqli_query($conn, $sql);

		if (mysqli_num_rows($results) > 0) {
		    while($row = mysqli_fetch_assoc($results)) {
		        $ids = $row["id"];
		    }
		}

		$query_tenants = "SELECT id FROM tenants Where id = '$id'";
		$results_tenants = mysqli_query($conn, $query_tenants);

		if (mysqli_num_rows($results_tenants) > 0) {
		    while($row_tenants = mysqli_fetch_assoc($results_tenants)) {
		        $id_tenants = $row_tenants["id"];
		    }

		    /* Your database table goes here */
			$mysql_table = "tenants_econtact";
			$query="INSERT INTO ".$mysql_table."(id,name,contact,relation,tenants_id,created_date,created_by) 
				VALUES (NULL,'$this->ename','$this->econtact','$this->erelation', '$id_tenants','$created_date','$ids' )";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			/* Get a last row ID to send in message */
			$row_id = mysqli_insert_id($conn);

			if ($result) {
			    $success_text		= array();
				$success_msg = "Your data has been successfully saved!";
				$success_text[] = $success_msg;
				if ($success_text) {
					$_SESSION['SUCCESS_MSG'] = $success_text;
					session_write_close();
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$this->id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}

   }

   // update emergency contact in database
	public function updateEcontact($eid,$user_id,$ename,$econtact,$erelation)
   {
		require "../config/database.php";
		
		$this->id = $user_id;
		$this->ename = $ename;
		$this->econtact = $econtact;
		$this->erelation = $erelation;
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		    /* Your database table goes here */
			$mysql_table = "tenants_econtact";
			$query="UPDATE ".$mysql_table." SET name='$this->ename', contact='$this->econtact', relation='$this->erelation' WHERE id='$eid'";

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
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$this->id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }

   // save tri in database
	public function saveTenantsRentalInfo($user_id,$contract,$deposit,$utility,$mrent,$room_id)
   {
		require "../config/database.php";
		
		$this->id = $user_id;
		$this->contract = $contract;
		$this->deposit = $deposit;
		$this->utility = $utility;
		$this->mrent = $mrent;
		$this->room_id = $room_id;

		//set to become true for room validation
		$validate_room_db	 = true;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';

		/* Check room in database*/
		if ($validate_room_db) {
			$result = $this->validateRoomDb($room_id, $conn);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}
		/* If validation error occurs */
		if ($error_text) {

			$_SESSION['ERRMSG_ARR'] = $error_text;
			session_write_close();
			echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
			// header("location: ../views/user_profile.php?user_id=$this->id");
			exit();
		}
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		$created_date = date("d/m/Y");
		$id_admin = $_SESSION['userid'];

		$sql = "SELECT id FROM admin Where id = '$id_admin'";
		$results = mysqli_query($conn, $sql);

		if (mysqli_num_rows($results) > 0) {
		    while($row = mysqli_fetch_assoc($results)) {
		        $ids = $row["id"];
		    }
		}

		$query_tenants = "SELECT id FROM tenants Where id = '$user_id'";
		$results_tenants = mysqli_query($conn, $query_tenants);

		if (mysqli_num_rows($results_tenants) > 0) {
		    while($row_tenants = mysqli_fetch_assoc($results_tenants)) {
		        $id_tenants = $row_tenants["id"];
		    }

		    /* Your database table goes here */
			$mysql_table = "tenants_rental_info";
			$query="INSERT INTO ".$mysql_table."(id,tenants_id,contract,deposit,utility,mrent,room_id,created_date,created_by) 
				VALUES (NULL,'$id_tenants','$this->contract','$this->deposit','$this->utility','$this->mrent', '$this->room_id','$created_date','$ids' )";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			/* Get a last row ID to send in message */
			$row_id = mysqli_insert_id($conn);

			if ($result) {
			    $success_text		= array();
				$success_msg = "Your data has been successfully saved!";
				$success_text[] = $success_msg;
				if ($success_text) {
					$_SESSION['SUCCESS_MSG'] = $success_text;
					session_write_close();
					$results = $this->updateRoomDb($room_id, $conn);
					if ($results !== "valid") {
						$error_text[] = $results;
					}
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$this->id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}

   }

    // update tri in database
	public function updateTenantsRentalInfo($tri_id,$user_id,$contract,$deposit,$utility,$mrent,$room_id)
   {
		require "../config/database.php";
		
		$this->id = $tri_id;
		$this->contract = $contract;
		$this->deposit = $deposit;
		$this->utility = $utility;
		$this->mrent = $mrent;
		$this->room_id = $room_id;

		//set to become true for room validation
		$validate_room_db	 = true;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';

		/* Check room in database*/
		if ($validate_room_db) {
			$result = $this->validateRoomDb($room_id, $conn);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}
		/* If validation error occurs */
		if ($error_text) {

			$_SESSION['ERRMSG_ARR'] = $error_text;
			session_write_close();
			echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
			// header("location: ../views/user_profile.php?user_id=$user_id");
			exit();
		}
		
		$role = $_SESSION['role'];
		if($role == "Superadmin"){
			$status = "Approved";
		} else{
			$status = "Pending";
		}

		    /* Your database table goes here */
			$mysql_table = "tenants_rental_info";
			// to get back old room id to update back the number of availability
			$result_oldroom = $this->updateOldRoomDb($tri_id, $mysql_table, $conn);
					if ($result_oldroom !== "valid") {
						$error_text[] = $result_oldroom;
					}
			$query="UPDATE ".$mysql_table." SET contract='$this->contract', deposit='$this->deposit', utility='$this->utility', mrent='$this->mrent',room_id='$this->room_id' WHERE id='$tri_id'";

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
					$results = $this->updateRoomDb($room_id, $conn);
					if ($results !== "valid") {
						$error_text[] = $results;
					}
					echo("<script>location.href = '../views/user_profile.php?user_id=$this->id';</script>");
					// header("location: ../views/user_profile.php?user_id=$user_id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }

   /* Room in database */
	public function validateRoomDb($room_id, $conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! This room is full! Select another rooms.";


		/* Your database table goes here */
		$mysql_table = "rooms";

		/* Query to DB */
		$query = "SELECT availability FROM ".$mysql_table." WHERE id = '$room_id' ";
		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($conn);
		}

		while($row = $result->fetch_object()) {
			if($row->availability > 0){
				return "valid";
			}else{
				return $error_text;
			}
		}
		

	}

	/* To update room availability in database */
	public function updateRoomDb($room_id,$conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! Cannot update room availability!";

		/* Your database table goes here */
		$mysql_table = "rooms";
		/* Query to DB */
		$query_room = "SELECT availability FROM ".$mysql_table." WHERE id = '$room_id' ";
		/* Add data to DB */
		$result_room = mysqli_query($conn, $query_room);
		while($rows = $result_room->fetch_object()) {
			$availability = $rows->availability;
		}
		$total = $availability - 1 ;

		/* Query to DB */
		$query="UPDATE ".$mysql_table." SET availability='$total' WHERE id = '$room_id'";
		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($conn);
		}

		if ($result) {
			return "valid";
		}else{
			return $error_text;
		}
	}

	/* To update old room availability in database */
	public function updateOldRoomDb($tri_id, $mysql_table, $conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! Cannot update room availability!";

		/* Query to DB */
		$query_room = "SELECT room_id FROM ".$mysql_table." WHERE id = '$tri_id' ";
		/* Add data to DB */
		$result_room = mysqli_query($conn, $query_room);
		while($rows = $result_room->fetch_object()) {
			$room_id = $rows->room_id;
		}

		/* Your database table goes here */
		$mysql_table_rooms = "rooms";
		/* Query to DB */
		$query_availability = "SELECT availability FROM ".$mysql_table_rooms." WHERE id = '$room_id' ";
		/* Add data to DB */
		$result_availability = mysqli_query($conn, $query_availability);
		while($rows_availability = $result_availability->fetch_object()) {
			$availability = $rows_availability->availability;
		}
		$total = $availability + 1 ;

		/* Query to DB */
		$query="UPDATE ".$mysql_table_rooms." SET availability='$total' WHERE id = '$room_id'";
		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		/* If error occurs */
		if (!$result){
			$error_exists = true;
			$error_mysql = "Error database query: ".mysqli_error($conn);
		}

		if ($result) {
			return "valid";
		}else{
			return $error_text;
		}
	}
}
?>