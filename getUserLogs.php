<?
	header( "content-type: application/xml; charset=ISO-8859-15" );
	
	include("conectar.php");
	
	$username = $_REQUEST["username"];
	
	$link=conectar();
	
	$query = "SELECT id FROM biblioteca.usuaris where username = '$username'";
	
	$idUser = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	
	$idUser = mysql_fetch_row($idUser)[0];
	
	$query = "SELECT * FROM biblioteca.log where idUser = '$idUser'";
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	mysql_close($link);
	
	$xml = new DOMDocument( "1.0", "ISO-8859-15" );
	

    $xml_llistaLog = $xml->createElement("LlistaLogs");
	$i = 0;
	while($r = mysql_fetch_row($dadesSQL)){
		
		$xml_Log = $xml->createElement("Log");
		$xml_Log->setAttribute('idLog',strval($r[0]));
		$xml_Log->setAttribute('loginTimme',strval($r[2]));
		$xml_llistaLog->appendChild( $xml_Log);
		$i++;
	}
	$xml->appendChild($xml_llistaLog);
	
	mysql_free_result($dadesSQL);
   
   	echo $xml->saveXML();
   
   
	
?>

	

