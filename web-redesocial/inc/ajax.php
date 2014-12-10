<?
	date_default_timezone_set('America/Sao_Paulo');
	session_start();

	include "conexao.php";

	call_user_func_array($_GET['funcao'], $_POST);	

	function cadastro($nome, $sobrenome, $sexo, $nascimento, $cidade, $email, $senha){
		
		$sql = "INSERT INTO usuario (usu_nome, usu_sobrenome, usu_sexo, usu_dt_nascimento, usu_email, usu_senha, usu_tipo, id_cidade)
				VALUES ('$nome', '$sobrenome', '$sexo', '$nascimento', '$email', '$senha', 2, $cidade)";
		echo mysql_query($sql);
		$id_usuario = mysql_insert_id();
		echo $sql = "select *, DATE_FORMAT(usu_dt_nascimento, '%d/%m/%Y') as dt_nascimento_formatado from usuario 
					 inner join cidade USING (id_cidade)
					 inner join estado USING (id_estado)
					 inner join pais using (id_pais)
					 WHERE id_usuario = $id_usuario";
	    $res = mysql_query($sql);
		$_SESSION['usuario'] = mysql_fetch_assoc($res);
		mkdir("../img/usuarios/".$id_usuario."/imagens/", 0700, true);
	}
	
	function verifica_email($email){
		$sql = "select * from usuario where usu_email = '$email'";
		$res = mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($res)){
			echo 1;		
		}
	}
	function login($email, $senha){
		$sql = "select *, DATE_FORMAT(usu_dt_nascimento, '%d/%m/%Y') as dt_nascimento_formatado from usuario 
					 inner join cidade USING (id_cidade)
					 inner join estado USING (id_estado)
					 inner join pais using (id_pais)
					 WHERE usu_email = '$email'
				     AND usu_senha = '$senha'";
		$res = mysql_query($sql);
		if(mysql_num_rows($res)){
			$_SESSION['usuario'] = mysql_fetch_assoc($res);
		}
		echo mysql_num_rows($res);
	}
	
	function logoff(){
		unset($_SESSION['usuario']);
	}

	function publicar($publicar){
		$id_usuario = $_SESSION['usuario']['id_usuario'];
		$data = date('Y-m-d H:i:s');
		echo $sql = "INSERT INTO postagem(post_data, post_texto, id_usuario) 
				VALUES ('$data', '$publicar', $id_usuario)";	
	    mysql_query($sql);
	}
  
  	function excluir_registro($tabela, $id){
		$sql = "DELETE FROM $tabela WHERE id_$tabela = $id";
		if(mysql_query($sql)){
			echo "Registro excluir com sucesso.";
			
		}else{
			echo "Não foi possivel excluir o registro.";	
		}
	}
	
	function salvar_perfil($id_usuario, $nome, $sobrenome, $sexo, $nascimento, $email, $relacionamento, $escolaridade, $estado, $cidade){
		echo $sql = "UPDATE usuario SET	usu_nome = '$nome',  
				usu_sobrenome = '$sobrenome',
				usu_sexo = '$sexo', 
				usu_dt_nascimento = '$nascimento',
				usu_email = '$email', 
				usu_relacionamento = '$relacionamento',
				usu_escolaridade = '$escolaridade',
				id_cidade = $cidade
				WHERE id_usuario = '$id_usuario'";
		$res = mysql_query($sql);
		echo $sql = "select *, DATE_FORMAT(usu_dt_nascimento, '%d/%m/%Y') as dt_nascimento_formatado from usuario 
					 inner join cidade USING (id_cidade)
					 inner join estado USING (id_estado)
					 inner join pais using (id_pais)
					 WHERE id_usuario = $id_usuario";
	    $res = mysql_query($sql);
		$_SESSION['usuario'] = mysql_fetch_assoc($res);
	}
	
	function salvar_album($album_nome, $id_usuario){
		echo $sql = "INSERT INTO album(album_nome, id_usuario) VALUES('$album_nome', $id_usuario)";
		$res = mysql_query($sql);
		$id_album = mysql_insert_id();	
		echo $sql = "select * from usuario 
				 inner join album USING (id_usuario)
				 inner join imagem USING (id_album)
				 WHERE id_album = $id_album";
		$res = mysql_query($sql);		 
		mkdir("../img/usuarios/".$id_usuario."/imagens/albuns/".$id_album, 0700, true);

	}
  
  	function carregar_cidade($estado){
		$sql = "select * from cidade WHERE id_estado = '$estado'";
		$res = mysql_query($sql);
		$select = "";
		while($row = mysql_fetch_assoc($res)){
			$select.='<option value="'.$row['id_cidade'].'">'.$row['cid_nome'].'</option>';	
		}
		echo $select;
	}
	
	function adicionar_amigo($id_usuario){		
		$id_usuario_logado = $_SESSION['usuario']['id_usuario'];
		echo $sql = "INSERT INTO amigo(id_amigo, id_usuario, ami_situacao) VALUES($id_usuario,$id_usuario_logado,  2)";
		$res = mysql_query($sql);		
	}
		
	function aceitar_amigo($ami_situacao){
		echo $sql = "UPDATE amigo set ami_situacao = 1";
		$res = mysql_query($sql);
	}
	
	function recusar_amigo($id_amigo){
		echo $sql = "DELETE FROM amigo where id_amigo = $id_amigo";
		$res = mysql_query($sql);
	}
	
	function excluir_conta($id_usuario, $id_album){
		echo $sql_amigo = "DELETE FROM amigo where id_usuario = $id_usuario";
		echo $sql_post = "DELETE FROM postagem where id_usuario = $id_usuario";
		echo $sql_imagem = "DELETE FROM imagem where id_album = $id_album";
		echo $sql_album = "DELETE FROM album where id_usuario = $id_usuario";
		echo $sql_usuario = "DELETE FROM usuario where id_usuario = $id_usuario";
		mysql_query($sql_amigo);
		mysql_query($sql_post);
		mysql_query($sql_imagem);
		mysql_query($sql_album);
		mysql_query($sql_usuario);
		unset($_SESSION['usuario']);
		
	}
	
	function postagem_alterada($id_postagem, $post_texto, $id_usuario){
		$data = date('Y-m-d H:i:s');
		echo $sql = "UPDATE postagem SET 
					 post_data = '$data',
					 post_texto = '$post_texto'
					 where id_postagem = '$id_postagem'";		
	    mysql_query($sql);
	}
?>