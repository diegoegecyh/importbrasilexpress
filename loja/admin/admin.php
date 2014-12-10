<? session_start();

	include "inc/conexao.php";
	
	if(isset($_SESSION['loja']['admin'])){
		include "inc/tela.php";
	} else {
		include "inc/login.php";
	}
	
?>