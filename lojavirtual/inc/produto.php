<?
	$id_produto = $_GET['id'];
	$sql = "SELECT
			produto.pro_descricao, pro_valor, pro_detalhe, id_categoria, id_subcategoria,
			produto_imagem.img_caminho,
			produto.pro_desconto as desconto_produto,
			subcategoria.sub_desconto as desconto_subcategoria,
			categoria.cat_desconto as desconto_categoria,
			subcategoria.sub_descricao AS subcategoria,
			categoria.cat_descricao AS categoria,
			marca.id_marca as id_marca,
			marca.mar_descricao AS marca
			FROM produto
			INNER JOIN produto_imagem USING(id_produto)
			INNER JOIN subcategoria USING(id_subcategoria)
			INNER JOIN categoria USING(id_categoria)
			INNER JOIN marca ON categoria.id_marca = marca.id_marca 
			WHERE id_produto = $id_produto
			GROUP BY produto.id_produto";
	$res = mysql_query($sql);		
	$produto = mysql_fetch_assoc($res);
	
	
	$valorOriginal = $produto['pro_valor'];
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
	<a href=""><?=$produto['marca']?> </a> |
    <a href=""><?=$produto['categoria']?> </a> |
    <a href="produtos/<?=$produto['id_marca']?>/<?=$produto['id_categoria']?>/<?=$produto['id_subcategoria']?>">
		<?=$produto['subcategoria']?>
    </a>
</div>

<div class="produto_detalhe">
	<h1><?=utf8_encode($produto['pro_descricao'])?></h1>
    <div class="imagem_produto">
    	<img class="img_principal"
        	src="img/produto/<?=$produto['img_caminho']?>" />
    </div>
    
    <?
    	if($desconto){
	?>
    <span class="valor_original">De: R$ <?=moeda($valorOriginal)?></span>
    <strong class="valor_produto">Por: R$ <?=moeda($valorDesconto)?></strong>
    <?
		} else {
	?>
    <strong class="valor_produto">R$ <?=moeda($produto['pro_valor'])?></strong>
    <?
		}
	?>
    
    <span>à vista ou</span><br />

    <?
    	for($i=2; $i<=12; $i++){
	?>
    		<span class="parcela">
				<?=$i."x de R$ ".moeda($produto['pro_valor'] / $i)?>
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
    	<?=utf8_encode(nl2br($produto['pro_detalhe']))?>
    </span>
    
</div>