<div class="pagamento">
	<h1>Pagamento</h1>
    
    <strong>À vista no boleto com 5% de desconto</strong>
    <br />
	<input class="pagamento" type="radio" id="pagamento"
    	   name="pagamento" value="0" />
    <?
		$valor_a_vista =
		 				$_SESSION['total_pedido']
		  				- ($_SESSION['total_pedido'] / 100) * 5;
	?>
    <label for="pagamento">R$ <?=moeda($valor_a_vista)?></label>
    
    
    <div class="parcela_cartao">
		<strong>Ou parcelado no cartão de crédito</strong><br />
        
		<?
			for($i=1; $i<=12; $i++){
				if($i <= 6){
					$valor = $_SESSION['total_pedido'] / $i;
				} else {
					$valor = $_SESSION['total_pedido']
								 * pow((1 + 0.04), $i) / $i;
				}
		?> 
       		<input class="pagamento" type="radio" id="parcela<?=$i?>"
    	   			name="pagamento" value="<?=$i?>" />
                    
			<label for="parcela<?=$i?>">
            	<?= $i?>x de <strong>R$ <?=moeda($valor)?></strong>
			</label><br />
		<?
			}
		?>
        
    </div>
    
    
    <h1>Endereço para Entrega</h1>
    
    <strong>Selecione o endereço de entrega abaixo:</strong>
    <?
    	$sql = "SELECT *, cidade.descricao as cidade,
						uf.descricao as uf
				FROM endereco_entrega
				INNER JOIN cidade USING(id_cidade)
				INNER JOIN uf USING(id_uf)
				WHERE id_cliente = ".$_SESSION['cliente']['id_cliente'];
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res)){		
	?>
    <br />
    <input value="<?=$row['id_endereco_entrega']?>" class="entrega" type="radio" name="entrega"
    		id="entrega<?=$row['id_endereco_entrega']?>" />
	<label for="entrega<?=$row['id_endereco_entrega']?>">
    	Rua: <?=$row['rua']?><br />
        Número: <?=$row['numero']?><br />
        CEP: <?=$row['cep']?><br />
        Complemento: <?=$row['complemento']?><br />
        Cidade: <?=$row['cidade']?><br />
        UF: <?=$row['uf']?><br />
    </label> <br /><br />          
    <?
		}
	?>
	
    <a class="finalizar" href="javascript:finalizarPedido()">
    	Finalizar Pedido
	</a>
    
</div>