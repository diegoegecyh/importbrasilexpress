<?
	if(!isset($_SESSION['cliente'])){
?>
<div class="login">
	<strong>Faça seu login</strong>
	<label for="login_email">E-mail</label>
    <input type="text" id="login_email" /><br />
	<label for="login_senha">Senha</label>
    <input type="password" id="login_senha" /><br />
    <input type="hidden" id="destino"
    	value="<?=isset($_GET['finalizar']) ? "pagamento" : ""?>" />
    <input onclick="login()" type="button" value="Adentrar" />
</div>
<div class="login">
	<strong>Faça seu cadastro</strong>
    <label for="cadastro_nome">Nome</label>
    <input type="text" id="cadastro_nome" /><br />
	<label for="cadastro_email">E-mail</label>
    <input type="text" id="cadastro_email" /><br />
	<label for="cadastro_senha">Senha</label>
    <input type="password" id="cadastro_senha" /><br />
    <input onclick="cadastro()" type="button" value="Cadastrar" />
</div>
<? } else { include "pagamento.php"; } ?>
