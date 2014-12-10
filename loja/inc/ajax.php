<?
	session_start();
	
	include "../admin/inc/conexao.php";
	
	call_user_func_array($_GET['funcao'], $_POST);	
	
	function cadastro($nome, $email, $senha){
		$sql = "INSERT INTO cliente (nome, email, senha, tipo)
				VALUES ('$nome', '$email', '$senha', 2)";
		echo mysql_query($sql);
		$id_cliente = mysql_insert_id();
		$sql = "SELECT * FROM cliente WHERE id_cliente = $id_cliente";
		$res = mysql_query($sql);
		$_SESSION['cliente'] = mysql_fetch_assoc($res);
	}
	
	function login($email, $senha){
		$sql = "SELECT *
				FROM cliente
				WHERE tipo = 2
				AND email = '$email'
				AND senha = '$senha'";
		$res = mysql_query($sql);
		if(mysql_num_rows($res)){
			$_SESSION['cliente'] = mysql_fetch_assoc($res);
			echo 1;
		}
	}
	
	function logoff(){
		unset($_SESSION['cliente']);
		unset($_SESSION['carrinho']);
	}
	
	function adicionarProduto($id){
		
		if(isset($_SESSION['carrinho'])){
			foreach($_SESSION['carrinho'] as $chave => $produto){
				if($produto['id_produto'] == $id){
					if(verificarQtd($id, $_SESSION['carrinho'][$chave]['qtd']+1)){
						$_SESSION['carrinho'][$chave]['qtd']++;
						die;
					} else {
						echo "Quantidade em estoque insuficiente!";
						die;
					}
				}
			}
		}
		
		$sql = "SELECT 1 as qtd, produto.id_produto, descricao, valor,
				produto_imagem.caminho, desconto
				FROM produto
				INNER JOIN produto_imagem USING(id_produto)
				WHERE id_produto = $id";
		$res = mysql_query($sql);	
		$_SESSION['carrinho'][] = mysql_fetch_assoc($res);
	}
	
	function excluirProduto($id){
		foreach($_SESSION['carrinho'] as $chave => $produto){
			if($produto['id_produto'] == $id){
				unset($_SESSION['carrinho'][$chave]);
			}
		}
	}
	
	function alterarQtd($id, $qtd){
		if(verificarQtd($id, $qtd)){
			foreach($_SESSION['carrinho'] as $chave => $produto){
				if($produto['id_produto'] == $id){
					$_SESSION['carrinho'][$chave]['qtd'] = $qtd;
				}
			}
		} else {
			echo "Quantidade em estoque insuficiente!";
		}
	}
	
	function verificarQtd($id, $qtd){
		$sql = "SELECT saldo
				FROM produto
				WHERE id_produto = $id
				AND saldo >= $qtd";
		$res = mysql_query($sql);		
		return mysql_num_rows($res);
	}
	
	
	function finalizarPedido($pagamento, $entrega){
		
		if($pagamento == 0){
			$valor_pedido = $_SESSION['total_pedido']
		  					- ($_SESSION['total_pedido'] / 100) * 5;
		} else if($pagamento <= 6){
			$valor_pedido = $_SESSION['total_pedido'] / $pagamento;
		} else {
			$valor_pedido = $_SESSION['total_pedido']
							* pow((1 + 0.04), $pagamento) / $pagamento;
		}
		
		
		$sql = "INSERT INTO pedido
				VALUES( null,
						$entrega,
						$pagamento,
						".$_SESSION['cliente']['id_cliente'].",
						now(),
						$valor_pedido
					   )
			   ";
		mysql_query($sql);
		$id_pedido = mysql_insert_id();
		$_SESSION['id_pedido'] = $id_pedido;
		
		foreach($_SESSION['carrinho'] as $produto){
			$sql = "SELECT saldo
					FROM produto
					WHERE id_produto = ".$produto['id_produto'].
					" and saldo >= ".$produto['qtd'];
			$res = mysql_query($sql);
			if(mysql_num_rows($res)){
				
				$sql = "INSERT INTO item_pedido
						VALUES (null,
						".$produto['id_produto'].",
						$id_pedido,
						".$produto['qtd'].",
						".$produto['valor'] - $produto['desconto']."
						)";
				mysql_query($sql);
				
				$sql = "UPDATE produto
						SET saldo = saldo - ".$produto['qtd'].
						" WHERE id_produto = ".$produto['id_produto'];
				mysql_query($sql);		
				
				unset($_SESSION['carrinho']);	
				
			}
				
		}
		
	}	
	
?>