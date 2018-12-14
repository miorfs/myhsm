<?php	
	
	class login{
	public $email;
	public $password;
	public $name;
	
	
	public function __construct()
	{

	}
	
   public function setEmail($email){$this->email = $email;}
   public function getEmail(){return $this->email;}

   public function setPassword($password){$this->password = $password;}
   public function getPassword(){return $this->password;}
   
   public function validate($email, $password)
   {
   $this->email=$email;
   $this->password=$password;
  
   $this->setEmail($this->email);
   $this->setPassword($this->password);

		$validate_login	 = true;

		/* Error variables */
		$error_text		= array();
		$error_message	= '';

		/* Check Ic in database*/
		if ($validate_login) {
			$result = $this->checkLogin($email,$password);
			if ($result !== "valid") {
				$error_text[] = $result;
			}else{
				echo("<script>location.href = '../views/index.php';</script>");
			
			}
		}

		/* If validation error occurs */
		if ($error_text) {
			$_SESSION['ERRMSG_ARR'] = $error_text;
			session_write_close();
			echo("<script>location.href = '../index.php';</script>");
			
		}
	
    }

	public function checkLogin($email,$password) {
		require "../../config/database.php";
		$error_exists = false;
		$error_texts = "Oops! Please check your username/password!";

		// PHP code required by both registration and validation

		//ini_set("display_errors","1");
		//ERROR_REPORTING(E_ALL);
		CRYPT_BLOWFISH or die ('No Blowfish found.');

		//This string tells crypt to use blowfish for 5 rounds.
		$Blowfish_Pre = '$2a$05$';
		$Blowfish_End = '$';

		// PHP code you need to register a user
		// Blowfish accepts these characters for salts.
		$Allowed_Chars =
		'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
		$Chars_Len = 63;

		// 18 would be secure as well.
		$Salt_Length = 21;
		$mysql_date = date( 'Y-m-d' );
		$salt = "";

		for($i=0; $i<$Salt_Length; $i++)
		{
		    $salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
		}
		$bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
		$hashed_password = crypt($password, $bcrypt_salt);

			try{
			$pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

			$query = $pdo->prepare("SELECT * FROM admin WHERE email = '$email' ");
			$query->execute();

				while($admin = $query->fetch()){
				// echo $admin['name'];
				// echo $admin['email'];
				// echo $admin['salt'];
				// echo $admin['password'];

				$hashed_pass = crypt($password, $Blowfish_Pre . $admin['salt'] . $Blowfish_End);

					if ($hashed_pass == $admin['password']) {
					    // echo 'Password verified!';
					    $_SESSION['userid'] = $admin["id"];
						$_SESSION['name'] = $admin["name"];
						$_SESSION['email'] = $admin["email"];
						$_SESSION['role'] = "Superadmin";
						$_SESSION['STATUS'] = 1;
						$_SESSION['login'] = 1;
						return "valid";
					} else {
					    // echo 'There was a problem with your user name or password.';
					    return $error_texts;
					}
				}

				/* Close connection */
				$pdo = null;
			}
			catch(PDOException $e){
					$error_exists = true;
					$error_pdo =  "Database error: " . $e->getMessage();
					return $error_texts;
			}

			return $error_exists ? $error_texts : $error_texts;
   	
	}
	
public function logout()
{
 //Unset the variables stored in session
 session_destroy();
 echo "<script type='text/javascript'>window.location='../index.php' </script>";
}
}

?>

