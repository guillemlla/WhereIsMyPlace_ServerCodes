<?
	header( "content-type: application/xml; charset=ISO-8859-15" );
	
	include("conectar.php");
	
	//Estat-> Retorna 0 si comfirmada, 1 si falta comfirmacio per part de username, 2
	// si falta comfirmacio per l'altre part.
	
	
	$username = $_REQUEST["username"];
	
	$link=conectar();
	
	$query = "SELECT id FROM biblioteca.usuaris where username = '$username'";
	$idUser = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	$idUser = mysql_fetch_row($idUser)[0];


	mysql_close($link);
	$link=conectar();
	
	$query = "SELECT iduser2,estat FROM biblioteca.connexions where iduser1 = '$idUser'";
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	mysql_close($link);
	
	$xml = new DOMDocument( "1.0", "ISO-8859-15" );
	
    $xml_llistaConnexions= $xml->createElement("LlistaConnexions");
    
	while($r = mysql_fetch_row($dadesSQL)){
		
		$xml_Connexio = $xml->createElement("Connexio");
		$xml_Connexio->setAttribute('userConnectat',strval($r[0]));
		$xml_Connexio->setAttribute('estat',strval($r[1]));
		$xml_llistaConnexions->appendChild( $xml_Connexio);
	}
	mysql_free_result($dadesSQL);
	
	$link=conectar();
	
	$query = "SELECT iduser1,estat FROM biblioteca.connexions where iduser2 = '$idUser'";
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	mysql_close($link);
	
	while($r = mysql_fetch_row($dadesSQL)){
		
		$xml_Connexio = $xml->createElement("Connexio");
		$xml_Connexio->setAttribute('userConnectat',strval($r[0]));
		$estat = -1;
		if($r[1] == 1) $estat =2;
		if($r[1] == 2) $estat =1;
		if($r[1] == 0) $estat =0;
		$xml_Connexio->setAttribute('estat',strval($estat));
		$xml_llistaConnexions->appendChild( $xml_Connexio);
	}
	
	$xml->appendChild($xml_llistaConnexions);
	
	mysql_free_result($dadesSQL);
   
   	echo $xml->saveXML();

	
?>

	

