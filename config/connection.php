<?php

require "debug.php";

$localhost	 = true;
$server		 = false;

if($server){
	debug_to_console( "Server connected!" );
}
if($localhost){
	debug_to_console( "Localhost connected!" );
}

?>