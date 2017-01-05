<?
	header( "content-type: application/xml; charset=ISO-8859-15" );
	include("conectar.php");
	
	$link=conectar();
	
	$query = "SELECT * FROM biblioteca.biblioteca";
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	mysql_close($link);
	
	$xml = new DOMDocument( "1.0", "ISO-8859-15" );
	

    $xml_llistaSensors = $xml->createElement("LlistaSensors");
	$i = 0;
	while($r = mysql_fetch_row($dadesSQL)){
		
		$xml_sensor = $xml->createElement("Sensor");
		$xml_sensor->setAttribute('idIntel',strval($r[0]));
		$xml_sensor->setAttribute('idSensor',strval($r[1]));
		$xml_sensor->setAttribute('planta',strval($r[2]));
		$xml_sensor->setAttribute('taula',strval($r[3]));
		$xml_sensor->setAttribute('grupTaula',strval($r[4]));
		$xml_sensor->setAttribute('estat',strval($r[5]));
		$xml_llistaSensors->appendChild( $xml_sensor);
		$i++;
	}
	$xml->appendChild($xml_llistaSensors);
	
	mysql_free_result($dadesSQL);
   
   	echo $xml->saveXML();
   
   
	
?>

	

