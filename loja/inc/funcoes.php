<?
	function carregar_produto($sql){
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res)){
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

<?
	function moeda($valor){
		return number_format($valor, 2, ",", ".");
	}
?>