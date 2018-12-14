 <?php
  class houseinfo{
	        	        
	
	public function __construct()
	{
					
	}
	

	public function getHouseInfo($house_id)
	{	
		$error_text = "Oops! There is no data in table.";

		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "houses";
		$mysql_table_join = "rooms";
		$mysql_table_join_admin = "admin";
		$mysql_table_join_detail = "house_detail";

		/* Query to DB */
		$query = "SELECT  h.id AS house_id,h.house_name,h.address,h.city,h.state,h.postcode,h.created_by,h.created_date, 
					r.id AS room_id, r.room_name, r.capacity, a.nickname AS admin_nickname,
					hd.id AS detail_id,hd.owner_name,hd.monthly_rent,hd.room,hd.toilet,hd.facilities
		FROM ". $mysql_table. " AS h 
		INNER JOIN ". $mysql_table_join_admin. " AS a 
			ON h.created_by = a.id 
		LEFT JOIN ". $mysql_table_join. " AS r 
			ON h.id = r.house_id 
		LEFT JOIN ". $mysql_table_join_detail. " AS hd 
			ON h.id = hd.house_id

		WHERE h.id = $house_id";

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