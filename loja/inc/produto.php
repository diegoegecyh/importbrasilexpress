<?
	$id_produto = $_GET['id'];
	$sql = "SELECT
			produto.descricao, valor, detalhe, id_categoria, id_subcategoria,
			produto_imagem.caminho,
			produto.desconto as desconto_produto,
			subcategoria.desconto as desconto_subcategoria,
			categoria.desconto as desconto_categoria,
			subcategoria.descricao AS subcategoria,
			categoria.descricao AS categoria
			FROM produto
			INNER JOIN produto_imagem USING(id_produto)
			INNER JOIN subcategoria USING(id_subcategoria)
			INNER JOIN categoria USING(id_categoria)
			WHERE id_produto = $id_produto
			GROUP BY produto.id_produto";
	$res = mysql_query($sql);		
	$produto = mysql_fetch_assoc($res);
	
	
	$valorOriginal = $produto['valor'];
	if($produto['desconto_produto']){
		$desconto = $produto['desconto_produto'];
		$valorDesconto = $valorOriginal - $desconto;
		
	} else if($produto['desconto_subcategoria']){
		$desconto = $produto['desconto_subcategoria'];
		$valorDesconto = $valorOriginal - (($valorOriginal / 100) * $desconto);
		
	} else if($produto['desconto_categoria']){
		$desconto = $produto['desconto_categoria'];
		$valorDesconto = $valorOriginal - (($valorOriginal / 100) * $desconto);		
	} else {
		$desconto = 0;
	}
	
?>
<div class="caminho">
	<a href=""><?=$produto['categoria']?> </a> |
    <a href="produtos/<?=$produto['id_categoria']?>/<?=$produto['id_subcategoria']?>">
		<?=$produto['subcategoria']?>
    </a>
</div>
<div class="produto_detalhe">
	<h1><?=utf8_encode($produto['descricao'])?></h1>
    <div class="imagem_produto">
    	<img class="img_principal"
        	src="img/produto/<?=$produto['caminho']?>" />
    </div>
    
    <?
    	if($desconto){
	?>
    <span class="valor_original">De: R$ <?=moeda($valorOriginal)?></span>
    <strong class="valor_produto">Por: R$ <?=moeda($valorDesconto)?></strong>
    <?
		} else {
	?>
    <strong class="valor_produto">R$ <?=moeda($produto['valor'])?></strong>
    <?
		}
	?>
    
    <span>à vista ou</span><br />

    <?
    	for($i=2; $i<=12; $i++){
	?>
    		<span class="parcela">
				<?=$i."x de R$ ".moeda($produto['valor'] / $i)?>
            </span><br />
    <?
		}
	?>
    <a href="javascript:adicionarProduto(<?=$id_produto?>)">
    	Comprar
    </a>
    
    <br clear="all" />
    <h2>Especificações</h2>
    <span class="detalhe_produto">
    	<?=utf8_encode(nl2br($produto['detalhe']))?>
    </span>
    
</div>