<?
	session_start();
	include "inc/conexao.php";
	include "inc/funcoes.php";
	$raiz = "http://".$_SERVER['HTTP_HOST']."/web-redesocial/";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?=$raiz?>" />
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/funcoes.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<title>On Life</title>
</head>
<body>
    <div class="geral">
    	
    	<?
			if(isset($_SESSION['usuario'])){
				include "inc/".$_GET['p'].".php";
			}else{
				include "inc/login.php";	
			}
		?>
    </div>
</body>
</html>