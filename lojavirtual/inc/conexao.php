<?
	$raiz = "http://".$_SERVER['HTTP_HOST']."/web-redesocial/";
	
	$con = mysql_connect("localhost","root","root");
	
	if(!$con){
		echo "Falha na conexão <br/>".mysql_error();
	}
	
	$db = mysql_select_db("lojavirtual");
	if(!$db){
		echo "Base de dados não selecionada <br/>".mysql_error();
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');

?>