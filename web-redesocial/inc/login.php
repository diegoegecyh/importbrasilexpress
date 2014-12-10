<?
	include "consulta_generica.php";
?>

<div class="login">
    <label for="login_email">E-mail</label>
    <input type="text" id="login_email" />
    <label for="login_senha">Senha</label>
    <input type="password" id="login_senha" />
    <input onclick="login()" type="button" value="Entrar" /><br />
</div>
     
<div class="conteudo">

    <div class="imagem_logo">
        <a href=""><img src="img/logofinal5.png" width="600" height="450"/> </a><br />
        <strong>O mundo ligado em apenas um lugar</strong><br />
        <span>Encontre antigos amigos ou faça novas amizades,<br/>
            divirta-se e mostre a todos os seus amigos como o seu dia esta.</span>
    </div>
    
    <div class="cadastro">
        <div class="cadastro_campos">
            <strong>Faça seu cadastro</strong><br />
            <strong>É Gratis</strong><br />
            <label for="cadastro_nome">Nome</label>
            <input type="text" id="cadastro_nome" /><br />     
            <label for="cadastro_sobrenome">Sobrenome</label>
            <input type="text" id="cadastro_sobrenome" /><br />     
            <label for="cadastro_sexo">Informe seu sexo</label>
            <select name="cadastro_sexo" id="cadastro_sexo">
                <option></option>
                <option>Masculino</option>
                <option>Feminino</option>
            </select><br />
            <label for="cadastro_nascimento"> Data de Nascimento</label>          
            <input type="text" id="cadastro_nascimento" placeholder="dd/mm/aaaa"/><br />
            <label for="estado">Estado</label>
            <select id="estado" name="estado"  onchange="carregar_cidade()">
            
				<? 
        			carregar_select('estado', 'est_nome')
                ?>
            </select><br />
            <label for="cadastro_cidade">Cidade</label>
            <select id="cidade" name="cadastro_cidade">  	
              
                <? 
                    carregar_select('cidade', 'cid_nome')
                ?>
            </select><br />
            <label for="cadastro_email">E-mail</label>
            <input type="text" id="cadastro_email"  onblur="verifica_email(this)"/><br />  
            <label for="cadastro_cemail">Confirmar E-mail</label>
            <input type="text" id="cadastro_cemail" /><br />  
            <label for="cadastro_senha">Senha</label>
            <input type="password" id="cadastro_senha" /><br />         
            <label for="cadastro_csenha">Confirmar Senha</label>
            <input type="password" id="cadastro_csenha" /><br /> 
            <input id="cadastro" onclick="cadastro()" type="button" value="Cadastre-se" />  
        </div>
    </div>
</div>