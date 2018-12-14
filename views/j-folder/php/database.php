<?php

require "../../../config/connection.php";

/* Define your data to access MySQL database */
if ($localhost){

	define("REG_USER", "ihsm");						// your username
	define("REG_SERVER", "localhost");				// your host
	define("REG_PASSWORD", "ihsm");					// your password
	define("REG_DATABASE", "ihsm");					// your database

}

if ($server){

	define("REG_USER", "ihsm");						// your username
	define("REG_SERVER", "192.227.247.46");	// your host
	define("REG_PASSWORD", "ihsm");					// your password
	define("REG_DATABASE", "ihsm");					// your database

}

?>