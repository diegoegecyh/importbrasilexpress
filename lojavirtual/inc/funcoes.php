<?
	function carregar_produto($sql){
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res) or die.mysql_error()){
			$valor =  $row['pro_valor'] - $row['pro_desconto'];
?>
            <div class="produto">
                <img title="<?=$row['img_legenda']?>" src="img/<?=$row['img_caminho']?>" />
                <strong><?=utf8_encode($row['pro_descricao'])?></strong><br />
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