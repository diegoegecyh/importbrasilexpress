<?	
	$id_usuario = $_SESSION['usuario']['id_usuario'];
	if(!isset($_GET['perfil'])){	
		if(count($_FILES)){
			if(!$_FILES['arquivo']['type'] == "image/jpeg"){
				echo "Tipo de arquivo invalido. Permitido somente JPG";	
			}else if($_FILES['arquivo']['size'] > 3*1024*1024){
				echo "Tamanho do arquivo invalido. Maximo permitido 3mb";
			}else{
				$imagem = uniqid().".jpg";
				$nome = "img/usuarios/".$id_usuario."/imagens/".$imagem;
				move_uploaded_file($_FILES['arquivo']['tmp_name'], $nome);
				$sql = "UPDATE usuario set usu_img_perfil = '$imagem'
						 WHERE id_usuario = $id_usuario";
				mysql_query($sql);
				$_SESSION['usuario']['usu_img_perfil'] = $imagem;
			}
		}
		$imagem_perfil = $_SESSION['usuario']['usu_img_perfil'];
	}
?>

<meta http-equiv="pragma" content="no-cache" />
<link href="css/estilo_perfil.css" rel="stylesheet" type="text/css"  media="all"/>

<div class="topo">
	
    <div class="logo">
    	<a href="perfil"><strong>On Life Social Networking</strong></a>
	</div>
    <div class="topo_nome_logoff"
		<?
            if(isset($_SESSION['usuario'])){
        ?>	 
                <span>Olá <strong><?=$_SESSION['usuario']['usu_nome']?></strong>, seja bem vindo.</span>
                <input type="button" value="Sair" onclick="javascript:logoff()" />
        <?
            }
        ?>
    </div>
</div>
<div class="pagina_perfil">
	<br clear="all" />
    <div class="perfil_esquerdo">
    	<div class="perfil_img">
        	<a href="perfil"><img src="<?= $_SESSION['usuario']['usu_img_perfil'] ? 
								 "img/usuarios/".$id_usuario."/imagens/".$imagem_perfil."?cache=".uniqid(): "img/img_inicial.PNG"?>" 
                                 width="175" height="128" /></a>
         	<form action="" method="post" enctype="multipart/form-data">      
                <input type="file" name="arquivo" />
                <input type="submit" value="Enviar" />
			</form> 
        </div>
        <div class="perfil_dados">
       		<a href="novidades">Novidades</a><br />
            <?
            	if(!isset($_GET['perfil'])){
			?>
           			<a href="editar_perfil">Editar Perfil</a><br />
            <?
				}
			?>
            <a href="album">Albuns de Foto</a>
        	<a href="amigos">Amigos</a><br /> 
            <?
            	$sql_usu_album = "select * from usuario
							inner join album using (id_usuario)
							inner join imagem using (id_album)
							where id_usuario = $id_usuario";
				$res_usu_album = mysql_query($sql_usu_album);
				$usu_album = mysql_fetch_assoc($res_usu_album)
			?>
            <?
            	if(!isset($_GET['perfil'])){
			?>
            		<a href="javascript:excluir_conta(<?=$id_usuario?>,  <?=$usu_album ? $usu_album['id_album'] : 0 ?>)">Excluir Conta</a>
            <?
				}
			?>
        </div>
    </div>
    
    <div class="perfil_status">
		<textarea id="publicar" placeholder="Compartilhe o que você esta pensando."></textarea>
        <div class="botoes">
			<a class="publicar"  href="javascript:publicar()">Publicar</a>
		</div>
    </div>
    <div class="perfil_direito">
		<div class="anuncio">
        	<img src="img/anuncio.png" width="200" height="200"/>   		
        </div>    
    </div>
    
    <div class="perfil_meio">
    	<?
			if(isset($_GET['p2'])){	
					include "inc/".$_GET['p2'].".php";
			}
		?>
    </div>
     

</div