<?php

require "connection.php";

/* Define your data to access MySQL database */
if ($localhost){

	define("REG_USER", "ihsm");						// your username
	define("REG_SERVER", "localhost");				// your host
	define("REG_PASSWORD", "ihsm");					// your password
	define("REG_DATABASE", "ihsm");					// your database

}

if ($server){

	define("REG_USER", "ihsm");						// your username
	define("REG_SERVER", "postgres");	// your host
	define("REG_PASSWORD", "ihsm");					// your password
	define("REG_DATABASE", "ihsm");					// your database

}

?>