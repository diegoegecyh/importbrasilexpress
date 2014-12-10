<?
	if($_POST){
		extract($_POST);
		
		$sql = "SELECT * FROM cliente
				WHERE email = '$login'
				AND senha = '$senha'
				AND tipo = 1";
		
		$res = mysql_query($sql);

		if(mysql_num_rows($res)){
			$row = mysql_fetch_assoc($res);
			$_SESSION['loja']['admin'] = $row;
			header("Location: $raiz");
		} else {
			echo "Login invalido";
		}
	}
?>
<form action="" method="post">
	<fieldset>
        <label for="login">Login</label><br />
        <input type="text" id="login" name="login" /><br />
        
        <label for="senha">Senha</label><br />
        <input type="password" id="senha" name="senha" /><br />
        
        <input type="submit" value="Logar" />
    </fieldset>
</form>