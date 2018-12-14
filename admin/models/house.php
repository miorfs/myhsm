 <?php
 // house registration
  class house{
	        	        
	public $id;
	public $house_id;
	public $hname;
	public $address;
	public $city;
	public $postcode;
	public $state;
	public $oname;
	public $mrent;
	public $droom;
	public $toilet;
	public $facilities;
	
	public function __construct()
	{
					
	}
   
   public function setAddress($address){$this->address = $address;}
   public function getAddress(){return $this->address;}
   
   public function setCity($address){$this->city = $city;}
   public function getCity(){return $this->city;}
   
   public function setPostcode($postcode){$this->postcode = $postcode;}
   public function getPostcode(){return $this->postcode;}
   
   public function setState($state){$this->state = $state;}
   public function getState(){return $this->state;}

   
   
   public function regHouse($hname,$address,$city,$state,$postcode)
   {
		require "../config/database.php";
		
		$this->hname = $hname; 
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->postcode = $postcode;

		//set to become true for nickname validation
		$validate_address_db	 = true;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';


		/* Check nickname in database*/
		if ($validate_address_db) {
			$result = $this->validateAddressDb($address, $conn);
			if ($result !== "valid") {
				$error_text[] = $result;
			}
		}

		/* If validation error occurs */
		if ($error_text) {

			$_SESSION['ERRMSG_ARR'] = $error_text;
			session_write_close();
			echo("<script>location.href = '../views/reg_house.php';</script>");
			// header("location: ../views/reg_house.php");
			exit();
		}


		$created_date = date("d/m/Y");
		$id = $_SESSION['userid'];

		$sql = "SELECT id FROM admin Where id = '$id'";
		$results = mysqli_query($conn, $sql);

		if (mysqli_num_rows($results) > 0) {
		    while($row = mysqli_fetch_assoc($results)) {
		        $ids = $row["id"];
		    }
		}

		/* Your database table goes here */
		$mysql_table = "houses";
		$query="INSERT INTO ".$mysql_table."(id,house_name,address,city,state,postcode,created_date,created_by) 
			VALUES (NULL,'$this->hname','$this->address','$this->city', '$this->state', '$this->postcode','$created_date','$ids' )";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		if ($result) {
			$query_number="SELECT id FROM houses";
			$result_query = mysqli_query($conn,$query_number);
			$number = mysqli_num_rows($result_query);
			$query_update = "UPDATE row_count SET total_house='$number' WHERE id=1";
			$result_update = mysqli_query($conn,$query_update);

		    $success_text		= array();
			$success_msg = "Your data has been successfully saved!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/reg_house.php';</script>");
				// header("location: ../views/reg_house.php");
				exit();
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
		
   }


	/* Address in database */
	public function validateAddressDb($address, $conn) {
		// require "../config/database.php";
		
		$error_text = "Oops! House already registered!";

		/* Your database table goes here */
		$mysql_table = "houses";

		/* Query to DB */
		$query = "SELECT address FROM ".$mysql_table." WHERE address = '$address' ";
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

	 // update address contact in database
	public function updateAddress($house_id,$hname,$address,$city,$state,$postcode)
   {
		require "../config/database.php";
		
		$this->house_id = $house_id;
		$this->hname = $hname;
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->postcode = $postcode;
		

		    /* Your database table goes here */
			$mysql_table = "houses";
			$query="UPDATE ".$mysql_table." SET house_name='$this->hname', address='$this->address', city='$this->city', state='$this->state', postcode='$this->postcode' WHERE id='$house_id'";

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
					echo("<script>location.href = '../views/house_info.php?house_id=$this->house_id';</script>");
					// header("location: ../views/house_info.php?house_id=$this->house_id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }
// save detail house
   public function saveDetail($house_id,$oname,$mrent,$droom,$toilet,$facilities)
   {
		require "../config/database.php";
		$this->house_id = $house_id;
		$this->oname = $oname; 
		$this->mrent = $mrent;
		$this->droom = $droom;
		$this->toilet = $toilet;
		$this->facilities = $facilities;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';


		/* If validation error occurs */
		if ($error_text) {

			$_SESSION['ERRMSG_ARR'] = $error_text;
			session_write_close();
			echo("<script>location.href = '../views/house_info.php?house_id=$this->house_id';</script>");
			// header("location: ../views/house_info.php?house_id=$this->house_id");
			exit();
		}


		$created_date = date("d/m/Y");
		$ids = $_SESSION['userid'];

		/* Your database table goes here */
		$mysql_table = "house_detail";
		$query="INSERT INTO ".$mysql_table."(id,house_id,owner_name,monthly_rent,room,toilet,facilities,created_date,created_by) 
			VALUES (NULL,'$this->house_id','$this->oname','$this->mrent', '$this->droom', '$this->toilet', '$this->facilities','$created_date','$ids' )";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		if ($result) {
		    $success_text		= array();
			$success_msg = "Your data has been successfully saved!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/house_info.php?house_id=$this->house_id';</script>");
				// header("location: ../views/house_info.php?house_id=$this->house_id");
				exit();
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
		
   }

    // update house detail in database
	public function updateDetail($house_id,$detail_id,$oname,$mrent,$droom,$toilet,$facilities)
   {
			require "../config/database.php";
			
			$this->house_id = $house_id;
			$this->oname = $oname; 
			$this->mrent = $mrent;
			$this->droom = $droom;
			$this->toilet = $toilet;
			$this->facilities = $facilities;
		

		    /* Your database table goes here */
			$mysql_table = "house_detail";
			$query="UPDATE ".$mysql_table." SET owner_name='$this->oname', monthly_rent='$this->mrent', room='$this->droom', toilet='$this->toilet', facilities='$this->facilities' WHERE id='$detail_id'";

			/* Add data to DB */
			$result = mysqli_query($conn, $query);

			if ($result) {
			    $success_text		= array();
				$success_msg = "Your data has been successfully updated!";
				$success_text[] = $success_msg;
				if ($success_text) {
					$_SESSION['SUCCESS_MSG'] = $success_text;
					session_write_close();
					echo("<script>location.href = '../views/house_info.php?house_id=$this->house_id';</script>");
					// header("location: ../views/house_info.php?house_id=$this->house_id");
					exit();
				}
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		

   }

	

   
}

	

?>