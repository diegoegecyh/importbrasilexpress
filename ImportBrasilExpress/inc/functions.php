<?
	$mysqli = new mysqli('localhost', 'root', 'root', 'importbrasilexpress');

	function carregar_produto($sql){
		$query = $mysqli->query($sql);
		while($row = $query->mysqli_fetch_assoc()){
			$valor =  $row['valor'] - $row['desconto'];
?>
            <div class="produto">
                <img title="<?=$row['legenda']?>" src="img/produto/<?=$row['caminho']?>" />
                <strong><?=utf8_encode($row['descricao'])?></strong><br />
                <span>R$ <?= number_format($valor,2,",",".")?></span>
                <a href="produto/<?=$row['id_produto']?>">Comprar</a>
            </div>
<?			
		}
	}
?>
