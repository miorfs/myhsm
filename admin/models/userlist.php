 <?php
  class userlist{
	        	        
	
	public function __construct()
	{
					
	}
	
  
	public function getAdminData()
	{	
		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "admin";

		/* Query to DB */
		$query = "SELECT * FROM ". $mysql_table;
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

	public function getTenantsMaleData()
	{	
		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "tenants";
		$mysql_table_join = "admin";

		/* Query to DB */
		
		// $query = "SELECT t.id,t.name,t.nickname, t.ic, t.contact, t.status, t.created_date, a.nickname AS admin_nickname FROM tenants t, admin a WHERE t.created_by = a.id";
		$query = "SELECT  t.id,t.name,t.nickname, t.ic, t.contact, t.status, t.created_date, a.nickname AS admin_nickname
		FROM ". $mysql_table. " AS t INNER JOIN ". $mysql_table_join. " AS a ON t.created_by = a.id WHERE t.gender = 'Male'";

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
			
		    return $result;
		}else{
			return $error_text;
		}

	}


	public function getTenantsFemaleData()
	{	
		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "tenants";
		$mysql_table_join = "admin";

		/* Query to DB */
		$query = "SELECT  t.id,t.name,t.nickname, t.ic, t.contact, t.status, t.created_date, a.nickname AS admin_nickname
		FROM ". $mysql_table. " AS t INNER JOIN ". $mysql_table_join. " AS a ON t.created_by = a.id WHERE t.gender = 'Female'";

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
			
		    return $result;
		}else{
			return $error_text;
		}

	}

} 
	

?>