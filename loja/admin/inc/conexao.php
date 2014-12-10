<?
	$raiz = "http://".$_SERVER['HTTP_HOST']."/loja/admin/";
	
	$con = @mysql_connect("localhost","root","root");
	if(!$con){
		echo "Falha na conexão <br/>".mysql_error();
	}
	
	$db = @mysql_select_db("loja");
	if(!$db){
		echo "Base de dados não selecionada <br/>".mysql_error();
	}
	
?>