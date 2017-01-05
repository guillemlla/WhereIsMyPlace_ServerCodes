<?
	
	include("conectar.php");
	
	$username1 = $_REQUEST["username1"];
	$username2 = $_REQUEST["username2"];
	//Username1 demana conexio i manca acceptarla per username2
	
	$link=conectar();
	
	$query = "SELECT id FROM biblioteca.usuaris where username = '$username1'";
	$idUser1 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	$idUser1 = mysql_fetch_row($idUser1)[0];
	
	$link=conectar();
	
	$query = "SELECT id FROM biblioteca.usuaris where username = '$username2'";
	$idUser2 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	$idUser2 = mysql_fetch_row($idUser2)[0];
	
	$link = conectar();
	
	$query = "SELECT * FROM biblioteca.connexions where (iduser1 =$idUser1 and idUser2=$idUser2) or (idUser1 =$idUser2 and idUser2=$idUser1)";
	
	$result = mysql_query($query);
	
	if(mysql_num_rows($result)==0){
	
		$query = "INSERT INTO biblioteca.connexions VALUES ('$idUser1','$idUser2',2)";		
    	$result = mysql_query($query);
    	if(!$result){
    		 echo 0;  //No se han podido introducir los datos en la tabla
    		 die('Consulta no válida: ' . mysql_error());
    	}else{
    		echo 1; //Conexio establerta
   	 	}
	
	}else{
	
		return 10; //connexio existent
		return 2000;
	}
	
	mysql_close($link);
	
?>

	

