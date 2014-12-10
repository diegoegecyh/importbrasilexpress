<?

	$con = mysqli_connect("localhost", "root", "root");
	if(!$con){
		echo "Falha na conexão <br/>".mysql_error();
	}
	
	$db = mysqli_select_db($con, "importbrasilexpress");
	if(!$db){
		echo "Base de dados não selecionada <br/>".mysql_error();
	}


?>