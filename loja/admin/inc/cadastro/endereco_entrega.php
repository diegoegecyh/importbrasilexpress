<?
	$tabela = "endereco_entrega";
	$campo  = "rua";
	
	include "inc/sql.php";

?>

<h1>Endereço de Entrega</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden" value="<?= isset($row) ? $editar_registro : "" ?>" />
      
    <label for="id_cidade">Cidade</label><br/>
    <select id="id_cidade" name="id_cidade"  
    	<? 
			$id = isset($row['id_cidade']) ? $row['id_cidade'] : 0;
			carregar_select('cidade', 'descricao', $id)
		?>
    </select><br/>
	
    <label for="rua">Rua</label><br/>
    <input value="<?= isset($row) ? $row['rua'] : "" ?>" type="text" id="rua" name="rua"/><br/>
    
    <label for="numero">Número</label><br />
	<input value="<?= isset($row) ? $row['numero'] : "" ?>" type="text" id="numero" name="numero"/><br/>
 
 	<label for="cep">Cep</label><br/>
	<input value="<?= isset($row) ? $row['cep'] : "" ?>" type="text" id="cep" name="cep"/><br/>
    
    <label for="complemento">Complemento</label><br />
	<input value="<?= isset($row) ? $row['complemento'] : "" ?>" type="text" id="complemento" name="complemento"/><br/>
    
    <label for="perido_entrega">Período de Entrega</label><br />
	<input value="<?= isset($row) ? $row['periodo_entrega'] : "" ?>" type="text" id="periodo_entrega" name="periodo_entrega"/><br/>
    
   	<input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>"/>
</form>


<table border="1">
	<tr>
    	<td>Cidade</td>
		<td>Rua</td>
        <td>Número</td>
		<td>Cep</td>
        <td>Complemento</td>
        <td>Período de Entrega</td>
        <td>Editar</td>
		<td>Excluir</td>
	</tr>
<?
	$sql = "SELECT * FROM $tabela ORDER BY $campo";
	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
?>
	<tr>
   		<td><?=$row['id_cidade']?></td>
		<td><?=$row["$campo"]?></td>
		<td><?=$row["numero"]?></td>
        <td><?=$row['cep']?></td>
		<td><?=$row["complemento"]?></td>
        <td><?=$row['periodo_entrega']?></td>
		<td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
		<td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
	</tr>
<?
	}
?>

</table>
