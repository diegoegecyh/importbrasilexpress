<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciator System Plus Tabajara</title>



<link href="css/estilo.css" type="text/css" rel="stylesheet" />
<script src="../js/jquery-1.10.2.min.js"></script>
<script>
	var raiz = "<?=$raiz?>inc/ajax.php";
</script>
<script src="js/funcoes.js"></script>

</head>

<body>
	<div class="menu">
    	<a href="categoria">Categoria</a>
        <a href="subcategoria">Subcategoria</a>
    </div>
    
    <div class="cadastro">
    	<?
			if($_GET['p']){
				include "inc/cadastro/".$_GET['p'].".php";
			}
		?>
    </div>
    
    <form id="form_editar" action="" method="post">
    	<input type="hidden" name="editar_registro" id="editar_registro" />
    </form>
    
</body>

</html>
