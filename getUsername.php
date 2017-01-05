<?
	
	include("conectar.php");
	
	$idUser = $_REQUEST["idUser"];
	
	$query = "SELECT username FROM `usuaris` WHERE id= '$idUser'";
	
	$link=conectar();
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
   
   	echo mysql_fetch_row($dadesSQL)[0];
   
?>
