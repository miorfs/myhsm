 <?php
  class picture{
	        	        
	
	public function __construct()
	{
					
	}

	public function getProfilePicture($user_id)
	{	
		$error_text = "Oops! There is no data in table.";
		define("REG_USERs", "root");						// your username
		define("REG_SERVERs", "localhost");						// your host
		define("REG_PASSWORDs", "");					// your password
		define("REG_DATABASEs", "rsystem");					// your database

	/* Variables */
		$error_exists = false;
		$error_mysql = "";

		/* Connection to DB */
		/* Constants, that defined in action.php, are used */
		$conn = mysqli_connect(REG_SERVERs, REG_USERs, REG_PASSWORDs, REG_DATABASEs);
		if (mysqli_connect_error()) {
			$error_mysql = ("Error connecting to database (" . mysqli_connect_errno() . ") ". mysqli_connect_error());
			
		}
		mysqli_set_charset($conn, 'utf8');

		// require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "profile_picture";

		// search user id
		$query_user = "SELECT * FROM profile_picture ";
		$result_query = mysqli_query($conn, $query_user);
		if($result_query){
			while($row_user = $result_query->fetch_object()){
				if($row_user->user_id == $user_id ){
					/* Query to DB */
					$queryss = "SELECT  *
					FROM ". $mysql_table. " 
					WHERE user_id = $user_id";
					/* Add data to DB */
					$resultss = mysqli_query($conn, $queryss);

					/* Get a last row ID to send in message */
					$row_id = mysqli_insert_id($conn);
					/* If error occurs */
					if (!$resultss){
						$error_exists = true;
						$error_mysql = "Error database query: ".mysqli_error($conn);
					}

					if (mysqli_num_rows($resultss) > 0) {
						return $resultss;
					}else{
						return $error_text;
					}
					
				}


			}
			return null;
			
		}
	}

} 
	

?>