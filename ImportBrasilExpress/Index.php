<?
	session_start();
	include "inc/conection.php";
	$raiz = "http://".$_SERVER['HTTP_HOST']."/ImportBrasilExpress/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?=$raiz?>" />
<script src="js/jquery-2.1.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<title>Import Brasil Express</title>
</head>

<body>
    <div class="container">
 		<div id="header" class="row">

			<div class="row">
               <div class="navbar navbar-default" role="navigation">
                     <div class="navbar-header pull-left ">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                             <span class="sr-only"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                         </button>
                     </div>    
                     <div class="navbar-collapse collapse" >
                        <ul class="nav navbar-nav" >
                            <li class="active"><a href="#index">INÍCIO</a></li>
                            <li class="dropdown">
                              <a href="produtos" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">PRODUTOS 
                              <span class="caret"></span></a>
                              
                              <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-submenu">
                                	<a tabindex="-1" href="prod_masculino">Masculino</a>
                                    <ul class="dropdown-menu">
                                      <li><a tabindex="-1" href="prod_masculino/camisetas">Camistas</a></li>
                                      <li><a tabindex="-1" href="prod_masculino/camisas">Camisas</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                	<a tabindex="-1" href="prod_feminino">Faminino</a>
                                    <ul class="dropdown-menu">
                                      <li><a tabindex="-1" href="vestidos">Vestidos</a></li>
                                      <li><a tabindex="-1" href="bolsas">Bolsas</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                	<a tabindex="-1" href="prod_infantil">Infantil</a>
                                    <ul class="dropdown-menu">
                                      <li><a tabindex="-1" href="vestidos">Vestidos</a></li>
                                      <li><a tabindex="-1" href="bolsas">Bolsas</a></li>
                                    </ul>
                                </li>
                              </ul>
                              
                               
                              
                            </li>
                            <li><a href="#termos_frete">TERMOS DE COMPRA</a></li>
                            <li><a href="#about">SOBRE NÓS</a></li>
                        </ul>
                        <div class="pull-right">
                       		<button id="login" type="button" class="btn btn-warning navbar-btn" >Login</button>
                        	<button id="cadastro" type="button" class="btn btn-primary navbar-btn">Cadastro</button>
                        </div>
                     </div>   

               </div>
			</div>
         
        </div>
 		<div id="content" class="row">
        	<div class="row col-md-10 col-lg-10 col-xs-12 col-sm-12 col-md-offset-1 col-lg-offset-1">
            	<div class="slideshow">
					<?
                        include "inc/slideshow.php";
                    ?> 
                </div>
            </div>
            <div class="row">
				<?
					include "inc/produtos.php";
            	?>
            </div>
        </div>       
    </div>
    <script type="text/javascript" src="js/functions.js"></script>

</body>
</html>