<?
	include "conexao.php";
	
	call_user_func_array($_GET['funcao'], $_POST);	
	
	function excluir_registro($tabela, $id){
		$sql = "DELETE FROM $tabela WHERE id_$tabela = $id";
		if(mysql_query($sql)){
			echo "Registro excluído com sucesso";
		} else {
			echo "Não foi possível excluir o registro!";
		}
	}
	
	
	
?>