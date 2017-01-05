<?
	header( "content-type: application/xml; charset=ISO-8859-15" );
	
	include("conectar.php");
	
	$usernames = $_REQUEST["usernames"];
	
	$users = explode("%",$usernames);	
	
	$query = "SELECT username,numPlanta,tempsActualitzacio FROM biblioteca.usuaris where ";
	
	for($i=0;count($users)-1>$i;$i++){
	
		$query = $query . "username='$users[$i]' or ";
	}
	$tamanyo = count($users)-1;
	$query = $query ."username='$users[$tamanyo]'";
	
	$link=conectar();
	
	$dadesSQL = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	
	$xml = new DOMDocument( "1.0", "ISO-8859-15" );

    $xml_llistaUsuari = $xml->createElement("LlistaUsuari");
	$i = 0;
	while($r = mysql_fetch_row($dadesSQL)){
		
		$xml_User = $xml->createElement("Usuari");
		$xml_User->setAttribute('username',strval($r[0]));
		$xml_User->setAttribute('numPlanta',strval($r[1]));
		$xml_User->setAttribute('tempsActualitzacio',strval($r[2]));
		$xml_llistaUsuari->appendChild( $xml_User);
		$i++;
	}
	$xml->appendChild($xml_llistaUsuari);
	
	mysql_free_result($dadesSQL);
   
   	echo $xml->saveXML();
   
?>

	

