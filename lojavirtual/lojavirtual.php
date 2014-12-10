<?
	session_start();
	include "inc/conexao.php";
	include "inc/funcoes.php";
	$raiz = "http://".$_SERVER['HTTP_HOST']."/lojavirtual/";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?=$raiz?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/funcoes.js"></script>
<script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#getEndereco").click(function(){
			getEndereco($("#cadastro_inp_cep").val());
		}); 
	 });
</script> 

<title>So mais um minuto</title>
</head>
<body>
<div class="site">

    <div class="loja_topo">
    	<div class="menu_superior">
            <a href="" id="home">Home</a>
            <a href="">Sobre Nós</a>
            <a href="">Segurança</a>
            <a href="">Parceiros</a>
		</div>
        
        <div class="caixa_carrinho">
       		<div class="caixa_carrinho_icone">
            	<a href="carrinho"><img src="img/carrinho.png" width="80px" height="55px" /></a>
            </div>
            <div class="caixa_carrinho_fundo">
                
                <strong id="nome_carrinho">Carrinho</strong><br />
                <?
					if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho'])){
						$total_carrinho = 0;
						foreach($_SESSION['carrinho'] as $produto){
							$total_carrinho += $produto['qtd'];
						}
                ?>
                        <a id="str_qtd" href="carrinho"><strong><?=$total_carrinho?></strong>
                        <span id="spa_produto"> produto<?= $total_carrinho == 1 ? "" : "s"?></span></a>
                <?
                	} else {
                ?>
                        <strong>vazio</strong>
                <?
               		}
                ?>                
            </div>
        </div>
        
        <div class="logo">
            <a href=""><img src="img/logo1.png" width="600" height="200"  /></a>
        </div>
        <?
            if(!isset($_SESSION['usuario'])){
		?>
                <div class="escolha_login">
                    <strong>Logar</strong><br />
                    <label for="login_email">E-mail</label><br />
                    <input type="text" id="login_email" /><br />
                    <label for="login_senha">Senha</label><br />
                    <input type="password" id="login_senha" /><br />
                    <a href="">Esqueceu a senha</a><br />
                    <input id="entrar" onclick="login()" type="button" value="Entrar" />            
                    <span>ou</span>
                    <a id="cadastro" href="cadastro">Cadastrar</a>
                </div>
        <?
			}else {
		?>
        		<div class="boas_vindas">
                    <span id="boas_vindas">Seja bem vindo</span>
                    <strong><?=$_SESSION['usuario']['usu_apelido']?></strong>
                    <a id="sair" href="" onclick="javascript:logoff()">Sair</a>
                </div>
        <?
			}
		?>
        
         
        
    </div>
    <br clear="all" />

	<div class="busca">
    	
    	<form action="busca" method="post"> 
       		<strong>Pesquise pelo Produto desejado </strong>
            <input type="text" id="busca" name="busca"
                    placeholder="digite a palavra chave" />
            <input id="busca_submit" type="submit" value="Buscar" />
		</form>
    </div>
    <div class="centro">
        <div class="menu">
            <?
                $sqlMarca = "SELECT * FROM marca ORDER BY mar_descricao";
                $resMarca = mysql_query($sqlMarca);
                while($rowMarca = mysql_fetch_assoc($resMarca)){
                    $id_marca = $rowMarca['id_marca'];
            ?>
                    <div class="marca">
                        <a href="javascript:mostrar_marca(<?=$id_marca?>)"><?=$rowMarca['mar_descricao']?></a>
                        <div id="marca_<?=$id_marca?>" class="categoria">
                            <?
                                $sqlCategoria = "SELECT * FROM categoria WHERE id_marca = $id_marca";
                                $resCategoria = mysql_query($sqlCategoria);
                                while($rowCategoria = mysql_fetch_assoc($resCategoria)){
                                    $id_categoria = $rowCategoria['id_categoria'];
                            ?>
                                    <a href="javascript:mostrar_categoria(<?=$id_categoria?>, <?=$id_marca?>)"><?=$rowCategoria['cat_descricao']?></a>	
                                    <div id="categoria_<?=$id_categoria?>" class="subcategoria">
                                        <?
                                            $sqlSubCategoria = "SELECT * FROM subcategoria
                                                            WHERE id_categoria = $id_categoria";
                                            $resSubCategoria = mysql_query($sqlSubCategoria);
                                            while($rowSubCategoria = mysql_fetch_assoc($resSubCategoria)){					
                                        ?>	
                                                <a href="produtos/<?=$id_marca?>/<?=$id_categoria?>/<?=$rowSubCategoria['id_subcategoria']?>">
                                                    <?=$rowSubCategoria['sub_descricao']?>
                                                </a>
                                        <?
                                            }
                                        ?>
                                    </div>
                            <?
                                }
                            ?>
                        
                        </div>
                    </div>
            <?
                }
            ?>
            
        </div>
        
        <div class="loja_meio">
            <?
                if(isset($_GET['p']))
                    include "inc/".$_GET['p'].".php";
                else
                    include "inc/inicio.php";
            ?>
        </div>
	</div>
    
</div>
</body>
</html>