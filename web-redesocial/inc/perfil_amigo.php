<?
	$id_amigo = $_GET['perfil'];	
	$sql = "select * from usuario
			left join amigo using (id_usuario) 
			where id_amigo = $id_amigo";
	$res = mysql_query($sql) or die(mysql_error()); 		
	$row = mysql_fetch_assoc($res);
	$id_usuario = $row['id_usuario'];
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
            <a href="perfil"><img src="<?= $row['usu_img_perfil'] ? 
								 "img/usuarios/".$id_usuario."/imagens/".$row['usu_img_perfil']."?cache=".uniqid(): "img/img_inicial.PNG"?>" 
                                 width="175" height="128" /></a>
         	<form action="" method="post" enctype="multipart/form-data">      
                <input type="file" name="arquivo" />
                <input type="submit" value="Enviar" />
			</form> 
        </div>
        <div class="perfil_dados">
       		<a href="novidades/<?=$id_amigo?>">Novidades</a><br />
            <a href="album/<?=$id_amigo?>">Albuns de Foto</a>
        	<a href="amigos/<?=$id_amigo?>">Amigos</a><br /> 
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
        
        <div class="usuarios">
        	<?
            	$sql = "select * from usuario
						where id_usuario <> $id_usuario
						GROUP BY usuario.id_usuario
						ORDER BY RAND()
						LIMIT 0,3";
				$res = mysql_query($sql);
				while($amigos = mysql_fetch_assoc($res)){
			?>
            		<div class="usuarios_possivel_amigo">
                        <img src="<?= $amigos['usu_img_perfil'] ? 
                                     "img/usuarios/".$id_usuario."/imagens/".$row['usu_img_perfil']."?cache=".uniqid(): "img/img_inicial.PNG"?>" 
                                     width="120" height="90" /><br />
                     	
                        <strong><?=$amigos['usu_nome']?></strong>   
                    </div>
                    
                    
            <?
				}
			?>;
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
