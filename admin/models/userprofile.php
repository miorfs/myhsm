 <?php
  class userprofile{
	        	        
	
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

	public function getUserProfile($user_id)
	{	
		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "tenants";
		$mysql_table_join = "admin";
		$mysql_table_join_address = "tenants_address";
		$mysql_table_join_econtact = "tenants_econtact";
		$mysql_table_join_picture = "profile_picture";
		$mysql_table_join_tri = "tenants_rental_info";

		/* Query to DB */
		// $query = "SELECT  t.id,t.name,t.nickname, t.ic, t.gender, t.contact, t.status, t.created_date, a.nickname AS admin_nickname
		// FROM ". $mysql_table. " AS t INNER JOIN ". $mysql_table_join. " AS a ON t.created_by = a.id WHERE t.id = $user_id";
		$query = "SELECT  t.id,t.name,t.nickname, t.ic, t.gender, t.contact, t.status, t.created_date, a.nickname AS admin_nickname , 
		ta.id AS aid,ta.address,ta.state, ta.city, ta.postcode, te.id AS eid, te.name AS ename, te.contact AS econtact, te.relation AS erelation, tri.id AS tri_id, tri.contract, tri.deposit, tri.utility, tri.mrent, tri.room_id
		FROM ". $mysql_table. " AS t 
		INNER JOIN ". $mysql_table_join. " AS a 
			ON t.created_by = a.id 
		LEFT JOIN ". $mysql_table_join_address. " AS ta 
			ON t.id = ta.tenants_id 
		LEFT JOIN ". $mysql_table_join_econtact. " AS te 
			ON t.id = te.tenants_id
		LEFT JOIN ". $mysql_table_join_tri. " AS tri 
			ON t.id = tri.tenants_id

		WHERE t.id = $user_id";

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

	public function getUserApproval($user_id)
	{	
		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "tenants";
		$mysql_table_join = "admin";

		$query = "SELECT  t.id,t.name,t.nickname, t.ic, t.gender, t.contact, t.status, t.created_date, a.nickname AS admin_nickname 
		FROM ". $mysql_table. " AS t 
		INNER JOIN ". $mysql_table_join. " AS a 
			ON t.created_by = a.id 

		WHERE t.id = $user_id";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);
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