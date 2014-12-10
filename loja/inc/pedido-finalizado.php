<div class="pedido-finalizado">
	<h1>Pedido finalizado!</h1>
    <strong>Anote o número do seu pedido!</strong>
    <h2><?= str_pad($_SESSION['id_pedido'],5,"0",STR_PAD_LEFT)?></h2>
    <a class="finalizar" href="">Continuar Comprando</a>
</div>

<?
	include "class.phpmailer.php";
	$mail = new PHPMailer();
	$mail->AddAddress($_SESSION['cliente']['email'], $_SESSION['cliente']['nome']);
	$mail->Host = "";
	$mail->Subject = "Pedido Finalizado";
	$mail->MsgHTML("Obrigado por comprar na nossa loja, 
					o número do seu pedido é<strong>".
					str_pad($_SESSION['id_pedido'],5,"0",STR_PAD_LEFT)).
					"</strong>";
	$mail->SetFrom('diegoluiz_22@hotmail.com', 'Loja TSI');
	if(!$mail->Send()){
		echo "E-mail não enviado: ". $mail->ErrorInfo;	
	} else {
		echo "E-mail enviado";
	}

	
	$mail = new PHPMailer();
	$mail->AddAddress("diegoluiz_22@hotmail.com", "Loja TSI");
	$mail->Host = "";
	$mail->Subject = "Pedido Finalizado";
	$mail->MsgHTML("O cliente <strong>".$_SESSION['cliente']['nome']."</strong> realizou o pedido: <strong>"
	               .str_pad($_SESSION['id_pedido'],5,"0",STR_PAD_LEFT))."</strong>";
				   
	$mail->SetFrom($_SESSION['cliente']['email'], $_SESSION['cliente']['nome']);
	if(!$mail->Send()){
		echo "E-mail não enviado: ". $mail->ErrorInfo;	
	} else {
		echo "E-mail enviado";
	}

?>