<?
	
	include("conectar.php");
	
	$username = $_REQUEST["username"];
	
	$query = "SELECT nomFoto FROM `usuaris` WHERE username = '$username'";
	
	$link=conectar();
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
   
   	echo mysql_fetch_row($dadesSQL)[0];
   
?>
