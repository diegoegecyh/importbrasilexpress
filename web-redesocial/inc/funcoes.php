<?		
	
	function carregar_imagens($sql){
	    $res = mysql_query($sql) or die(mysql_error()); 		
		$row = mysql_fetch_assoc($res);
		$id_usuario = $_SESSION['usuario']['id_usuario'];
		print_r($row['id_album']);
		if(count($_FILES)){
			for($i=0; $i < count($_FILES['arquivo']['name']); $i++){
			if(!$_FILES['arquivo']['type'][$i] == "image/jpeg"){
				echo "Tipo de arquivo invalido. Permitido somente JPG";	
			}else if($_FILES['arquivo']['size'][$i] > 3*1024*1024){
				echo "Tamanho do arquivo invalido. Maximo permitido 3mb";
			}else{
				$imagem = uniqid().".jpg";
				$nome = "img/usuarios/".$id_usuario."/imagens/albuns/".$row['id_album']."/".$imagem;
				move_uploaded_file($_FILES['arquivo']['tmp_name'][$i], $nome);
			}
		}
	}
?>
        <div class="img_principal">
            <strong>Fotos do Album</strong><br />
            <?
                while($row){	
            ?>
                    <div class="img_album">
                        <img title="<?=$row['img_descricao']?>"  src="<?="img/usuarios/".$id_usuario."/imagens/albuns/".$row['id_album'].
                                    "/".$row['img_caminho']?>" width="200" height="150" />
                    </div>
            <?			
                    
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label> Adicionar Fotos</label>
                <input multiple="multiple" type="file" name="arquivo[]" />
                
                <input type="submit" value="Enviar" />
            </form> 
        </div>
<?			

	}
?>

<?
	
	function carregar_usuario($sql){
		$res = mysql_query($sql);
	 	$imagem_perfil = $_SESSION['usuario']['usu_img_perfil'];
		$id_usuario_sessao = $_SESSION['usuario']['id_usuario'];
?>

	<div class="amigos">
		<strong>Amigos</strong><br />
	<?
        while($row = mysql_fetch_assoc($res)){	
    ?>
            <div class="dados_amigo">
                <div class="imagem_amigo">
                      <?
                        $id_usuario = $row['id_usuario'];
                        $sql = "select * from usuario
									left join amigo using (id_usuario) 
									where id_amigo in (select id_amigo from amigo where id_usuario = $id_usuario_sessao)";
                        $res2 = mysql_query($sql);
                        $row2 = mysql_fetch_assoc($res2);
						print_r($row2);
					?>
                    <?	
                        if($row2['ami_situacao'] == 1 ){
                    ?>
                  	 		<a href="perfil_amigo/<?=$row2['id_amigo']?>"><strong><?=$row['usu_nome']." ".$row['usu_sobrenome']?></strong></a><br />
                    <?
                        }else{
                    ?>
                    		<strong><?=$row['usu_nome']." ".$row['usu_sobrenome']?></strong>
                    <?
						}
					?>
                    <img id="img" src="<?= $row2['usu_img_perfil'] ? 
                        "img/usuarios/".$row['id_usuario']."/imagens/".$imagem_perfil : "img/img_inicial.PNG"?>" 
                         width="80" height="80" /> 
                  
                    	
               </div>
               <div class="botoes_add_exc">
                    <?	
                        if($row2['ami_situacao'] != 1 ){
                    
                    ?>
    
                            <a id="adicionar_amigo" href="javascript:adicionar_amigo(<?=$row['id_usuario']?>)"><strong>Adicionar</strong></a>			
                    <?
                        }else{
                    ?>
                    
                            <a id="recusar_amigo" href="javascript:recusar_amigo(<?=$row2['id_amigo']?>)"><strong>Excluir</strong></a>	
                    <?
                        }
                    ?>              
                </div>	
            </div>
    <?
        }
    ?>
	</div>

<?
}
?>

