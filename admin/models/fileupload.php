 <?php
  class fileupload{
	        	        
	
	public function __construct()
	{
					
	}
	
  
	public function uploadFile($final_file,$file_type,$new_size,$user_id)
	{	
		require "../config/database.php";

		$created_date = date("d/m/Y");
		$id_admin = $_SESSION['userid'];

		$sql = "SELECT id FROM admin Where id = '$id_admin'";
		$results = mysqli_query($conn, $sql);

		if (mysqli_num_rows($results) > 0) {
		    while($row = mysqli_fetch_assoc($results)) {
		        $ids = $row["id"];
		    }
		}

		/* Your database table goes here */
		$mysql_table = "profile_picture";
		$query="INSERT INTO ".$mysql_table."(id,file,type,size,user_id,created_date,created_by) 
			VALUES (NULL,'$final_file','$file_type', '$new_size','$user_id','$created_date','$ids' )";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		if ($result) {
		    $success_text = array();
			$success_msg = "Picture successfully uploaded!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/user_profile.php?user_id=$user_id';</script>");
				// header("location: ../views/user_profile.php?user_id=$user_id");
				exit();
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);

	}

	public function updateFile($pic_id,$final_file,$file_type,$new_size,$user_id)
	{	
		require "../config/database.php";

		/* Your database table goes here */
		$mysql_table = "profile_picture";
		$query="UPDATE ".$mysql_table." SET file='$final_file', type='$file_type', size='$new_size' WHERE id='$pic_id'";

		/* Add data to DB */
		$result = mysqli_query($conn, $query);

		/* Get a last row ID to send in message */
		$row_id = mysqli_insert_id($conn);

		if ($result) {
		    $success_text = array();
			$success_msg = "Picture successfully uploaded!";
			$success_text[] = $success_msg;
			if ($success_text) {
				$_SESSION['SUCCESS_MSG'] = $success_text;
				session_write_close();
				echo("<script>location.href = '../views/user_profile.php?user_id=$user_id';</script>");
				// header("location: ../views/user_profile.php?user_id=$user_id");
				exit();
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);

	}


} 
	

?>