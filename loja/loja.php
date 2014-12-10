<?
	session_start();
	include "admin/inc/conexao.php";
	include "inc/funcoes.php";
	$raiz = "http://".$_SERVER['HTTP_HOST']."/loja/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?=$raiz?>" />
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/funcoes.js"></script>
<title>Loja TSI</title>
</head>

<body>

<div class="geral">    
    <div class="topo">
    	<a href=""><div class="logo">LOJA TSI</div></a>
        <div class="caixa_busca">
        <?
        	if(isset($_SESSION['cliente'])){
		?>	
           	<span>
            	Olá <strong><?=$_SESSION['cliente']['nome']?></strong>
                , seja bem vindo. <a href="javascript:logoff()">Sair</a>
            </span><br />
        <?
			} else {
		?>    
            <span>
            	Faça seu <a href="login">Login</a> ou <a href="login">Cadastre-se</a>
            </span><br />
        <?
			}
		?>    
            <form action="busca" method="post"> 
                <input type="text" id="busca" name="busca"
                		placeholder="digite a palavra chave" />
				<input type="submit" value="Buscar" />
			</form>
        </div>
        
        <div class="caixa_carrinho">
        	<div class="caixa_carrinho_fundo">
                <a href="carrinho">Meu Carrinho</a><br />
       	<?
        	if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho'])){
				$total_carrinho = 0;
				foreach($_SESSION['carrinho'] as $produto){
					$total_carrinho += $produto['qtd'];
				}
		?>
        	<strong><?=$total_carrinho?></strong>
            <span> produto<?= $total_carrinho == 1 ? "" : "s"?></span>
        <?
			} else {
		?>
			<strong>vazio</strong>
		<?
			}
		?>                
            </div>
        </div>
        <br clear="all" />
    </div>
    
    <div class="menu">
    <?
    	$sqlCategoria = "SELECT * FROM categoria ORDER BY descricao";
		$resCategoria = mysql_query($sqlCategoria);
		while($rowCategoria = mysql_fetch_assoc($resCategoria)){
			$id_categoria = $rowCategoria['id_categoria'];
	?>
    	<div class="categoria">
        	<a href="javascript:mostrar_categoria(<?=$id_categoria?>)">
				<?=$rowCategoria['descricao']?>
            </a>
            <div id="categoria_<?=$id_categoria?>" class="subcategoria">
            <?
            	$sqlSubCategoria = "SELECT * FROM subcategoria
									WHERE id_categoria = $id_categoria";
				$resSubCategoria = mysql_query($sqlSubCategoria);
				while($rowSubCategoria = mysql_fetch_assoc($resSubCategoria)){					
			?>	
                <a href="produtos/<?=$id_categoria?>/<?=$rowSubCategoria['id_subcategoria']?>">
					<?=$rowSubCategoria['descricao']?>
                </a>
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
    	if(isset($_GET['categoria'])){
	?>
    	<script>
			$(document).ready(function(){
				mostrar_categoria(<?=$_GET['categoria']?>);
			})
		</script>
    <?		
		}
	?>    
    
    <div class="conteudo">
    	<?
        	if(isset($_GET['p']))
				include "inc/".$_GET['p'].".php";
			else
				include "inc/inicio.php";
		?>
    </div>
    
    <br clear="all" />
</div>

</body>
</html>