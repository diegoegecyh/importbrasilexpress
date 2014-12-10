<?
	$album = $_GET['album'];	
	echo $sql = "select * from usuario 
			 inner join album USING (id_usuario)
			 inner join imagem USING (id_album)
			 WHERE id_album = $album";
	carregar_imagens($sql);
?>

