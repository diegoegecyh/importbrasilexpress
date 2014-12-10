<?
	$tabela = "produto_imagem";
	$campo  = "caminho";
	
	include "inc/sql.php";

?>


<h1>Imagem do Produto</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden" value="<?= isset($row) ? $editar_registro : "" ?>" />
   
    <label for="id_produto">Produto</label><br/>
        <select id="id_produto" name="id_produto">
    	<? 
			$id = isset($row['id_produto']) ? $row['id_produto'] : 0;
			carregar_select('produto', 'descricao', $id)
		?>
    </select><br/>
    
    <label for="caminho">Caminho</label><br/>
    <input value="<?= isset($row) ? $row['caminho'] : "" ?>" type="text" id="caminho" name="caminho"/><br/>
    
    <label for="legenda">Legenda</label><br/>
    <input value="<?= isset($row) ? $row['legenda'] : "" ?>" type="text" id="legenda" name="legenda"/><br/>
    
    <label for="ordem">Ordem</label><br/>
    <input value="<?= isset($row) ? $row['ordem'] : "" ?>" type="text" id="ordem" name="ordem"/><br/>
   
   	<input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>"/>
</form>


<table border="1">
	<tr>
    	<td>Produto</td>
        <td>Caminho</td>
		<td>Legenda</td>
        <td>Ordem</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>
<?
	$sql = "SELECT * FROM $tabela ORDER BY $campo";
	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
?>
	<tr>
        <td><?=$row['id_produto']?></td> 
		<td><?=$row["$campo"]?></td>
        <td><?=$row['legenda']?></td>
        <td><?=$row['ordem']?></td>
		<td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
		<td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
	</tr>
<?
	}
?>

</table>
