<?
	session_start();
	
	include "conexao.php";
	
	call_user_func_array($_GET['funcao'], $_POST);	
	
	function cadastro($nome, $apelido, $cpf, $rg, $sexo, $nascimento, $tel_pre, $tel_res, $tel_cel, $email, $senha, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento ){
		$nascimento = implode("-",array_reverse(explode("/",$nascimento)));
		
		$scodificada = hash('whirlpool', $senha);
		
		$cpf_codificado = base64_encode($cpf);
		$rg_codificado = base64_encode($rg);
		
		/*busca o id do estado pelo valor retornado no cep*/
		$sqlEstado = "select * from estado 
				   where est_uf like '%$estado%'";
		$res_sqlEstado = mysql_query($sqlEstado);
		$row_sqlEstado = mysql_fetch_assoc($res_sqlEstado);
		$id_estado = $row_sqlEstado['id_estado'];
		
		/*busca o id da cidade pelo valor retornado cep*/
		$sqlCidade = "select * from cidade 
				   where id_estado = $id_estado 
				     and cid_nome like '%$cidade%'";
		$res_sqlCidade = mysql_query($sqlCidade);
		$row_sqlCidade = mysql_fetch_assoc($res_sqlCidade);
		$id_cidade = $row_sqlCidade['id_cidade'];
		
		/*Insere os dados na tabela usuario*/
		$sql = "INSERT INTO usuario(usu_nome, usu_sexo, usu_dataNascimento, usu_telefonePrerencial, usu_telefoneResidencial, 
									usu_telefoneCelular, usu_apelido, usu_email, usu_senha, usu_cpf, usu_rg)
				VALUES ('$nome', '$sexo', '$nascimento', '$tel_pre', '$tel_res', '$tel_cel', '$apelido', '$email', '$scodificada', '$cpf_codificado', '$rg_codificado')";
		echo mysql_query($sql) or die(mysql_error());
		$id_usuario = mysql_insert_id();
			
	    $sqlEndereco = "INSERT INTO endereco_usuario(id_usuario, end_cep, end_rua, end_bairro, end_numero, end_complemento, id_cidade) 
						VALUES($id_usuario, '$cep', '$rua', '$bairro', '$numero', '$complemento', $id_cidade)";
		mysql_query($sqlEndereco);
		
		
		$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
		$res = mysql_query($sql) or die(mysql_error());
		$_SESSION['usuario'] = mysql_fetch_assoc($res);
		
	}

	
	function login($email, $senha){
		$scodificada = hash('whirlpool', $senha);
		$sql = "SELECT *
				FROM usuario
				WHERE usu_email = '$email'
				AND usu_senha = '$scodificada'";
		$res = mysql_query($sql);
		if(mysql_num_rows($res)){
			$_SESSION['usuario'] = mysql_fetch_assoc($res);
			echo 1;
		}
	}
	
	function logoff(){
		unset($_SESSION['usuario']);
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
		
		$sql = "SELECT 1 as qtd, produto.id_produto, pro_descricao, pro_valor,
				produto_imagem.img_caminho, pro_desconto
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
		$sql = "SELECT pro_saldo
				FROM produto
				WHERE id_produto = $id
				AND pro_saldo >= $qtd";
		$res = mysql_query($sql);		
		return mysql_num_rows($res);
	}
	
?>