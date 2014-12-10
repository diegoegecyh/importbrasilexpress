<script>
	jQuery(function($){
	    $("#cadastro_inp_nascimento").mask("99/99/9999");
		$("#cadastro_inp_telefonePrerencial").mask("(99) 99999-9999");
		$("#cadastro_inp_telefoneResidencial").mask("(99) 99999-9999");
		$("#cadastro_inp_telefoneCelular").mask("(99) 99999-9999");
	});
</script>
<div class="login">
	<strong>Logar</strong><br />
    <label for="login_email">E-mail</label>
    <input type="text" id="login_email" />
    <label for="login_senha">Senha</label>
    <input type="password" id="login_senha" />
    <input id="entrar" onclick="login()" type="button" value="Entrar" />
    <a href="">Esqueceu a senha</a>
</div>

<div class="cadastro">
    <div class="cadastro_campos">
        <strong>Faça seu cadastro</strong><br />
        <label for="cadastro_nome">Nome</label>
        <input type="text" id="cadastro_inp_nome" /><br />     
        <label for="cadastro_apelido">Apelido</label>
        <input type="text" id="cadastro_inp_apelido" maxlength="10" /><br /> 
        <label for="cadastro_cpf">CPF</label>
        <input type="text" id="cadastro_inp_cpf" /><br /> 
        <label for="cadastro_rg">RG</label>
        <input type="text" id="cadastro_inp_rg" /><br /> 
        <label for="cadastro_nascimento"> Data de Nascimento</label>          
        <input type="text" id="cadastro_inp_nascimento" placeholder="DD/MM/AAAA" maxlength="10"/>
        <label id="cadastro_sexo" for="cadastro_sexo">Sexo</label>
        <select name="cadastro_sexo" id="cadastro_inp_sexo">
            <option></option>
            <option>Masculino</option>
            <option>Feminino</option>
        </select><br />
        <label for="cadastro_telefonePrerencial">Telefone Preferencial</label>
        <input type="text" id="cadastro_inp_telefonePrerencial" placeholder="(DDD) (TELEFONE)" maxlength="14"/><br /> 
        <label for="cadastro_telefoneResidencial">Telefone Residencial</label>
        <input type="text" id="cadastro_inp_telefoneResidencial" placeholder="(DDD) (TELEFONE)" maxlength="14"/><br />  
        <label for="cadastro_telefoneCelular">Telefone Celular</label>
        <input type="text" id="cadastro_inp_telefoneCelular" placeholder="(DDD) (TELEFONE)" maxlength="14"/><br />    
        <label for="cadastro_email">E-mail</label>
        <input type="text" id="cadastro_inp_email"/><br />  
        <label for="cadastro_cemail">Confirmar E-mail</label>
        <input type="text" id="cadastro_inp_cemail" /><br />  
        <label for="cadastro_senha">Senha</label>
        <input type="password" id="cadastro_inp_senha" /><br />         
        <label for="cadastro_csenha">Confirmar Senha</label>
        <input type="password" id="cadastro_inp_csenha" /><br /> 
    </div>
    <div class="campos_endereco">
        <strong>Cadatre seu endereço</strong><br /> 
        <span>Apos informar o CEP clique em pesquisar para carregar as informações do endereço.</span><br /><br />
       	<label for="cadastro_cep">CEP</label>   
        <input type="text" maxlength="8" value="" id="cadastro_inp_cep"/>
        <input type="button" id="getEndereco" value="Pesquisar"/><br/>
        <label for="cadastro_estado">Estado</label>
        <input type="text" readonly="readonly" id="cadastro_inp_estado"/>
        <label id="cadastro_cidade" for="cidade">Cidade</label>
       	<input type="text" readonly="readonly" id="cadastro_inp_cidade"/><br/>
        <label for="cadastro_bairro">Bairro</label>  
		<input type="text" readonly="readonly" id="cadastro_inp_bairro"/><br/>
        <label for="cadastro_rua">Rua</label>
        <input type="text" readonly="readonly" id="cadastro_inp_rua"/><br/>
        <label for="cadastro_numero">Número</label>
        <input type="text" id="cadastro_inp_numero"/><br/>
        <label for="cadastro_complemento">Complemento</label>
        <input type="text" id="cadastro_inp_complemento"/><br/>
    </div>
    
    <input id="cadastro" onclick="cadastro()" type="button" value="Cadastre-se" />  
</div>
