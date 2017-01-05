<?php
    function conectar(){
        $server="127.0.0.1";
	$user="root";
	$pass="";
	$db="biblioteca";
        
	$connection = mysql_connect($server, $user);

	if (!$connection) {
        	die('MySQL ERROR: ' . mysql_error());
	}
		
	mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

	return $connection;
    }
?>
