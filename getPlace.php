<?
	
	include("conectar.php");
	
	$idUser = $_REQUEST["idUser"];
	
	$query = "SELECT username,numPlanta,tempsActualitzacio FROM `usuaris` WHERE id= '$idUser'";
	
	$link=conectar();
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	
	$r = mysql_fetch_row($dadesSQL);
	
	$resultat = $r[0] . "%" . $r[1] . "%" . $r[2];
   
   	echo $resultat;
   
?>
