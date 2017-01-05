<?
	header( "content-type: application/xml; charset=ISO-8859-15" );
	
	include("conectar.php");
	
	$query = "SELECT username,nomFoto FROM `usuaris`";
	
	$link=conectar();
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
   
    $xml = new DOMDocument( "1.0", "ISO-8859-15" );
    $xml_llistaUsers = $xml->createElement("LlistaUsers");
   	while($r = mysql_fetch_row($dadesSQL)){

		$xml_User = $xml->createElement("User");
		$xml_User->setAttribute('username',strval($r[0]));
		$xml_User->setAttribute('idFoto',strval($r[1]));
		$xml_llistaUsers->appendChild( $xml_User);
	}
	$xml->appendChild($xml_llistaUsers);
	
	mysql_free_result($dadesSQL);
   
   	echo $xml->saveXML();
   
?>
