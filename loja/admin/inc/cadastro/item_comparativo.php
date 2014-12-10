<?
	$tabela = "item_comparativo";
	$campo  = "descricao";
	
	include "inc/sql.php";

?>


<h1>Item Comparativo</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden" value="<?= isset($row) ? $editar_registro : "" ?>" />
   
    <label for="id_subcategoria">Subcategoria</label><br/>
        <select id="id_subcategoria" name="id_subcategoria">
    	<? 
			$id = isset($row['id_subcategoria']) ? $row['id_subcategoria'] : 0;
			carregar_select('subcategoria', 'descricao', $id)
		?>
    </select><br/>
    
    <label for="id_comparativo">Comparativo</label><br/>
        <select id="id_comparativo" name="id_comparativo">
    	<? 
			$id = isset($row['id_comparativo']) ? $row['id_comparativo'] : 0;
			carregar_select('comparativo', 'descricao', $id)
		?>
    </select><br/>
    
    <label for="descricao">Descrição</label><br/>
    <input value="<?= isset($row) ? $row['descricao'] : "" ?>" type="text" id="descricao" name="descricao"/><br/>
   
   	<input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>"/>
</form>


<table border="1">
	<tr>
    	<td>Subcategoria</td>
        <td>Comparativo</td>
		<td>Descrição</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>
<?
	$sql = "SELECT * FROM $tabela ORDER BY $campo";
	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
?>
	<tr>
        <td><?=$row['id_subcategoria']?></td> 
        <td><?=$row['id_comparativo']?></td>
		<td><?=$row["$campo"]?></td>
		<td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
		<td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
	</tr>
<?
	}
?>

</table>
