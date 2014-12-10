<?
	$id_usuario = isset($_GET['perfil']) ? $_GET['perfil'] : $_SESSION['usuario']['id_usuario'];
	$sql = "SELECT * FROM album WHERE id_usuario = $id_usuario";
	$res = mysql_query($sql);
?>

<div class="album_fotos">
	<strong>Fotos</strong>
    <div class="criar_album">
    	<a id="btn_criar_album" class="btn_criar_album" href="javascript:criar_album()">Adicionar Album</a><br /><br />
        
        <input value="<?= $_SESSION['usuario']['id_usuario']?>" type="hidden" id="id_usuario" name="id_usuario" disabled="disabled"/><br />
   	    <label id="nome_album" for="nome_album" >Nome do Album</label>
		<input type="text" id="inp_nome_album" name="inp_nome_album" style="display: none" />
        
        <a id="btn_salvar_album" class="btn_salvar_album" href="javascript:salvar_album()" style="display:none">Salvar Album</a><br />
        
    </div>
    
    <div class="geral_albuns">
		<?
		    while($albuns = mysql_fetch_assoc($res)){
        ?>
                <div class="albuns">
                    	<a href="fotos/<?=$id_usuario?>/<?=$albuns['id_album']?>"><strong id="album_nome"><?=$albuns['album_nome']?></strong> </a>
                </div>
        <?
            }
        ?> 
    </div>

</div>