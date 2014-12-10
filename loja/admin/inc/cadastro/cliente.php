<?
	$tabela = "cliente";
	$campo  = "nome";
	
	include "inc/sql.php";

?>


<h1>Cliente</h1>

<form action="" method="post">
	<input name="id_<?=$tabela?>" type="hidden" value="<?= isset($row) ? $editar_registro : "" ?>" />
   
    <label for="nome">Nome</label><br/>
    <input value="<?= isset($row) ? $row['nome'] : "" ?>" type="text" id="nome" name="nome"/><br/>
   
    <label for="email">E-mail</label><br/>
    <input value="<?= isset($row) ? $row['email'] : "" ?>" type="text" id="email" name="email"/><br/>
    
    <label for="senha">Senha</label><br/>
    <input value="<?= isset($row) ? $row['senha'] : "" ?>" type="password" id="senha" name="senha"/><br/>
    
    <label for="tipo">Tipo</label><br/>
    <input value="<?= isset($row) ? $row['tipo'] : "" ?>" type="text" id="tipo" name="tipo"/><br/>
    
   	<input type="submit" value="<?= isset($row) ? "Salvar" : "Cadastrar" ?>"/>
</form>


<table border="1">
	<tr>
    	<td>Nome</td>
		<td>E-mail</td>
        <td>Senha</td>
		<td>Tipo</td>
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
		<td><?=$row['email']?></td>
        <td><?=$row['senha']?></td>
        <td><?=$row['tipo']?></td>
		<td><a href="javascript:editar_registro(<?=$row["id_$tabela"]?>)">Editar</a></td>
		<td><a href="javascript:excluir_registro('<?=$tabela?>',<?=$row["id_$tabela"]?>)">Excluir</a></td>
	</tr>
<?
	}
?>

</table>
