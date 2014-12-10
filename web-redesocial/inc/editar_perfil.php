<?
	include "consulta_generica.php";
?>

<div class="editar_perfil">
	<strong>Editar Perfil</strong>
    <input value="<?= $_SESSION['usuario']['id_usuario']?>" type="hidden" id="id_usuario" name="id_usuario" disabled="disabled"/><br />
    <label for="nome">Nome</label>
	<input value="<?= $_SESSION['usuario']['usu_nome']?>" type="text" id="nome" name="nome" disabled="disabled"/><br />
    <label for="sobrenome">Sobrenome</label>
	<input value="<?= $_SESSION['usuario']['usu_sobrenome']?>" type="text" id="sobrenome" name="sobrenome" disabled="disabled"/><br />
    <label for="sexo">Sexo</label>
	<input value="<?= $_SESSION['usuario']['usu_sexo']?>" type="text" id="sexo" name="sexo" disabled="disabled"/><br />
    <label for="dt_nascimento">Data Nascimento</label>
	<input value="<?= $_SESSION['usuario']['dt_nascimento_formatado']?>" type="text" id="dt_nascimento" name="dt_nascimento" disabled="disabled"/><br />
    <label for="email">E-mail</label>
	<input value="<?= $_SESSION['usuario']['usu_email']?>" type="text" id="email" name="email" disabled="disabled"/><br />
    <label for="relacionamento">Relacionamento</label>
	<input value="<?= $_SESSION['usuario']['usu_relacionamento']?>" type="text" id="relacionamento" name="relacionamento" disabled="disabled"/><br />
    <label for="escolaridade">Escolaridade</label>
	<input value="<?= $_SESSION['usuario']['usu_escolaridade']?>" type="text" id="escolaridade" name="escolaridade" disabled="disabled"/><br />
    <label for="estado">Estado</label>
    <select id="estado" name="estado"  onchange="carregar_cidade()" disabled="disabled">
    	<? 
			$id = isset($_SESSION['usuario']['id_estado']) ? $_SESSION['usuario']['id_estado'] : 0;
						carregar_select('estado', 'est_nome', $id)
		?>
    </select><br />
    
    <label for="cidade">Cidade</label>
    <select id="cidade" name="cidade" disabled="disabled">
		<? 
			$id = isset($_SESSION['usuario']['id_cidade']) ? $_SESSION['usuario']['id_cidade'] : 0;
							carregar_select('cidade', 'cid_nome', $id)
		?>
    </select>
    
    <div class="botoes_editar_perfil">
    	<a class="btn_editar_perfil" href="javascript:editar_perfil()">Editar</a>
    	<a class="btn_salvar_perfil" href="javascript:salvar_perfil()">Salvar</a>
    </div>
</div>
