<?
	$tabela = "produto";
	$campo  = "descricao";
	
	include "inc/sql.php";

?>

<h1>Produto</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden" value="<?= isset($row) ? $editar_registro : "" ?>" />
        
    <label for="id_marca">Marca</label><br/>
    <select id="id_marca" name="id_marca">
    	<? 
			$id = isset($row['id_marca']) ? $row['id_marca'] : 0;
			carregar_select('marca', 'descricao', $id)
		?>
    </select><br/>
    
    <label for="id_subcategoria">Subcategoria</label><br/>
    <select id="id_subcategoria" name="id_subcategoria">
    	<? 
			$id = isset($row['id_subcategoria']) ? $row['id_subcategoria'] : 0;
			carregar_select('subcategoria', 'descricao', $id)
		?>
    </select><br/>


    <label for="descricao">Descrição</label><br/>
    <input value="<?= isset($row) ? $row['descricao'] : "" ?>" type="text" id="descricao" name="descricao"/><br/>
 
 	<label for="valor">Valor</label><br/>
	<input value="<?= isset($row) ? $row['valor'] : "" ?>" type="text" id="valor" name="valor"/><br/>
    
    <label for="saldo">Saldo</label><br />
	<input value="<?= isset($row) ? $row['saldo'] : "" ?>" type="text" id="saldo" name="saldo"/><br/>
    
    <label for="desconto">Desconto</label><br />
	<input value="<?= isset($row) ? $row['desconto'] : "" ?>" type="text" id="desconto" name="desconto"/><br/>
    
   	<input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>"/>
</form>


<table style="width:800px" border="1">
	<tr>
    	<td>Marca</td>
		<td>Subcategoria</td>
        <td>Descricao</td>
        <td>Valor</td>
        <td>Saldo</td>
        <td>Desconto</td>
        <td>Editar</td>
		<td>Excluir</td>
	</tr>
<?
	$sql = "SELECT * FROM $tabela ORDER BY $campo";
	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
?>
	<tr>
   		<td><?=$row['id_marca']?></td>
        <td><?=$row['id_subcategoria']?></td>
		<td><?=$row["$campo"]?></td>
        <td><?=$row['valor']?></td>
		<td><?=$row["saldo"]?></td>
        <td><?=$row['desconto']?></td>
		<td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
		<td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
	</tr>
<?
	}
?>

</table>
