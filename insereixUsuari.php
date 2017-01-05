<?
	include("conectar.php");
	
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	
	$query = "Select * from usuaris where username = '$username'";
	
	$link=conectar();			
    $result = mysql_query($query);
    
    if(mysql_num_rows($result)==0){
    
    	$passwordHASH = md5($password);
		$query = "INSERT INTO `usuaris`(`username`, `pass`) VALUES ('$username','$passwordHASH')";		
    	$result = mysql_query($query);
    
    	if(!$result){
    		 echo 0;  //No se han podido introducir los datos en la tabla
    		 die('Consulta no válida: ' . mysql_error());
    	}else{
    		echo 1;
   	 	}

    }else{
     	mysql_close($link);
     	echo 10; //usuario existente
    }
    
	
?>

	

