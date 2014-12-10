<?
	
	$tabela = "postagem";
	
	$id_usuario = isset($_GET['perfil']) ? $_GET['perfil'] : $_SESSION['usuario']['id_usuario'];
	
	$sql = "select *, DATE_FORMAT(post_data, '%d/%m/%Y %H:%i:%s') as data_post_form from postagem
			left join usuario using (id_usuario)
			where postagem.id_usuario in (select id_usuario from amigo where id_amigo = $id_usuario or id_usuario = $id_usuario)
			or postagem.id_usuario in (select id_amigo from amigo where id_amigo = $id_usuario or id_usuario = $id_usuario)
			or postagem.id_usuario = $id_usuario
			order by data_post_form desc";			
	$res = mysql_query($sql);		
	

?>
<div class="convites">	
	<?
		
        $sql = "select * from usuario 
				left join amigo using(id_usuario)
				where ami_situacao = 2
				  and id_amigo = $id_usuario";
        $res2 = mysql_query($sql);
        
        
        while($row2 = mysql_fetch_assoc($res2)){
    ?>
			<div class="convite_acc_exc">
                <strong>Convites Pendentes</strong><br />
                <strong>Usuario: <?=$row2['usu_nome']?></strong>
                
                <a href="javascript:aceitar_amigo(<?=$row2['ami_situacao']?>)"><strong>Adicionar</strong></a>
                <a href="javascript:recusar_amigo(<?=$row2['id_usuario']?>)"><strong>Recusar</strong></a>
            </div>
    <?
    	}
	?>
    
    		
</div>
 

<div class="postagens">
		<?
		 	while($postagem = mysql_fetch_assoc($res)){		
		?>	
	     	<div class="post">
            	<img id="img" src="<?= $postagem['usu_img_perfil'] ? 
								 "img/usuarios/".$id_usuario."/imagens/".$postagem['usu_img_perfil']."?cache=".uniqid(): "img/img_inicial.PNG"?>" 
                                 width="40" height="40" />
                <strong id="post_nome"><?=$postagem['usu_nome']?></strong>
                <strong id="post_data"><?=$postagem['data_post_form']?></strong><br/>
			</div>
            <div class="post_texto">
                <strong>Postagem</strong><br />
                <textarea id="post_texto" disabled="disabled" ><?=$postagem['post_texto']?></textarea>
                
                <div class="exc_alt_post">
					<?
                        if($_SESSION['usuario']['id_usuario'] == $postagem['id_usuario']){
                    ?>
                            <a id="editar_postagem" href="javascript:editar_postagem(<?=$postagem['id_postagem']?>, <?=$postagem['id_usuario']?>)">Alterar</a>
                            <a href="javascript:excluir_registro('<?=$tabela?>',<?=$postagem["id_$tabela"]?>)">Excluir</a>
                    <?
                        }
                    ?>
           		</div>
            </div>

		<?
			}
		?>
</div>