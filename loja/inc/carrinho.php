<?
	if(!isset($_SESSION['carrinho']) || !count($_SESSION['carrinho'])){
?>
	<script>
    	window.location = "";
	</script>
<?
	}
?>
<div class="carrinho">
	<h1 class="">Carrinho</h1>
    
    <div class="cabecalho">
        <div class="foto">Foto</div>
        <div class="descricao">Descrição</div>
        <div class="qtd">Quantidade</div>
        <div class="v_unitario">V. Unitário</div>
        <div class="v_total">V. Total</div>
    </div>
    <?
    	$total = 0;
		foreach($_SESSION['carrinho'] as $produto){
			$valor = ($produto['valor'] - $produto['desconto']) * $produto['qtd'];
			$total += $valor;
	?>
    <div class="item_carrinho">
        <div class="foto">
        	<img src="img/produto/<?=$produto['caminho']?>" />
        </div>
        <div class="descricao"><?=$produto['descricao']?></div>
        <div class="qtd">
            <input type="text" value="<?=$produto['qtd']?>" id="qtd_<?=$produto['id_produto']?>" />
            <span onclick="alterarQtd(<?=$produto['id_produto']?>)">Atualizar Qtd</span>
            <span onclick="excluirProduto(<?=$produto['id_produto']?>)">Remover Produto</span>
        </div>
        <div class="v_unitario">
        	R$ <?=moeda($produto['valor'] - $produto['desconto'])?>
        </div>
        <div class="v_total">R$ <?=moeda($valor)?></div>
    </div>
    <br clear="all" />
    <?
		}
		$_SESSION['total_pedido'] = $total;
	?>
    
    <div class="valor_total">
    	<div class="total">Total</div>
        <div class="v_total">R$ <?=moeda($total)?></div>
    </div>
    <a class="finalizar" href="finalizar-pedido">Finalizar Pedido</a>

</div>








