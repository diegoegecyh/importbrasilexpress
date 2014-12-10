<div class="pesquisar">
	<form action="busca" method="post">
		<input type="text" id="busca" name="busca"
                		placeholder="Encontre seus amigos" />
				<input type="submit" value="Pesquisar" />
	</form>
</div>


<?
	$busca = $_POST['busca'];
	$where = " usu_nome like '%$busca%' or usu_sobrenome like '%$busca%' ";
	$sql = "SELECT *
			FROM usuario
			WHERE $where
			GROUP BY usuario.id_usuario";
	carregar_usuario($sql);
?>

