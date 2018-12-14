 <?php
  class studentlist{
	        	        
	
	public function __construct()
	{
					
	}

	public function getStudentList()
	{	
		$error_text = "Oops! There is no data in table.";

		require "../../config/database.php";

		/* Your database table goes here */
		$mysql_table = "student_info";
		$mysql_table_join = "student";
		$mysql_table_parent = "parent";
		$mysql_table_address = "address";

		try{
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			$query = $pdo->prepare("SELECT s.id, s.student_id, s.parent_id, std.name, std.ic, std.phone_no 
				FROM ". $mysql_table . " AS s 
				JOIN ". $mysql_table_join . " AS std 
				ON s.student_id = std.id
				JOIN ". $mysql_table_parent . " AS p
				ON s.parent_id = p.id");
			
			return $query->execute();


				// while($admin = $query->fetch()){

				// }
				/* Close connection */
				$pdo = null;
			}
			catch(PDOException $e){
					$error_exists = true;
					$error_pdo =  "Database error: " . $e->getMessage();
					return $error_texts;
			}

	}

} 
	

?>