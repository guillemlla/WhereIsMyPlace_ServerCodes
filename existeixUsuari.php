<?
	include("conectar.php");
	
	$username = $_REQUEST["username"];
	
	$link=conectar();
	
	$query = "SELECT username FROM biblioteca.usuaris WHERE username= '$username'";
	$dadesSQL = mysql_query($query);
	mysql_close($link);
	
    if (mysql_num_rows($dadesSQL)==0 ) {
    echo 0;
	}else{
		echo 1;
	}
	
?>

	

