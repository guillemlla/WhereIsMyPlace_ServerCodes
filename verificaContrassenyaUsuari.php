<?
	include("conectar.php");
	
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	
	$link=conectar();
	
	$query = "SELECT pass FROM biblioteca.usuaris WHERE username= '$username'";
	$dadesSQL = mysql_query($query);
	mysql_close($link);
	
    if (!$dadesSQL ) {
    echo 0;
    die('Consulta no válida: ' . mysql_error());
	}
	
	$passwordHASH = mysql_fetch_row($dadesSQL)[0];

	mysql_free_result($dadesSQL);
	if (md5($password) === $passwordHASH){
		
		echo 1;
	}else{
		echo 0;
	}

	
?>

	

