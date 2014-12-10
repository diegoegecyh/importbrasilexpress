<div class="pesquisar">
	<form action="busca" method="post">
		<input type="text" id="busca" name="busca" placeholder="Encontre seus amigos" />
		<input type="submit" value="Pesquisar" />
	</form>
</div>

<?
	$id_usuario = $_SESSION['usuario']['id_usuario'];
	
	$sql = "select *
		from usuario 
		left join amigo using (id_usuario)
		where id_usuario in (select id_amigo from amigo where id_usuario = $id_usuario and ami_situacao = 1)
		or  id_usuario in (select id_usuario from amigo where id_amigo = $id_usuario and ami_situacao = 1)
		group by id_usuario";
	carregar_usuario($sql);
	
?>



	


