<?
	$tabela = "cidade";
	$campo  = "descricao";
	
	include "inc/sql.php";

?>


<h1>Cidade</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden" value="<?= isset($row) ? $editar_registro : "" ?>" />
        
    <label for="id_uf">UF</label><br/>
    <select id="id_uf" name="id_uf"  
    	<? 
			$id = isset($row['id_uf']) ? $row['id_uf'] : 0;
			carregar_select('uf', 'descricao', $id)
		?>
    </select><br/>
   
    <label for="descricao">Descrição</label><br/>
    <input value="<?= isset($row) ? $row['descricao'] : "" ?>" type="text" id="descricao" name="descricao"/><br/>
   
   	<input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>"/>
</form>


<table border="1">
	<tr>
    	<td>UF</td>
		<td>Descrição</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>
<?
	echo $sql = "SELECT * FROM $tabela ORDER BY id_uf, $campo";
	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
?>
	<tr>
    	<td><?=$row['id_uf']?></td>
		<td><?=$row["$campo"]?></td>
		<td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
		<td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
	</tr>
<?
	}
?>

</table>
