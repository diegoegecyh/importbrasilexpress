<?
	$tabela = "categoria";
	$campo  = "descricao"; 
	
	include "inc/sql.php";
?>

<h1>Categoria</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden"
    		value="<?= isset($row) ? $editar_registro : "" ?>" />
            
    <label for="descricao">Descrição</label><br />
    <input value="<?= isset($row) ? $row['descricao'] : "" ?>" type="text" id="descricao" name="descricao" /><br />
    <label for="desconto">Desconto</label><br />
    <input value="<?= isset($row) ? $row['desconto'] : "" ?>" type="text" id="desconto" name="desconto" /><br />
    
    
    <input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>" />
</form>

<table width="100%" border="1">
    <tr>
        <td>Descrição</td>
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
        <td><?=$row["$campo"]?></td>
        <td><?=$row["desconto"]?></td>
        <td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
        <td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
    </tr>
<?
	}
?>   
</table>
