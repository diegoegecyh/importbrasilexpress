function login(){
	var email = $("#login_email").val();
	var senha = $("#login_senha").val();
	
	if(email == ""){
		alert("Preencha o campo e-mail");
	} else if(senha == ""){
		alert("Preencha o campo senha");
	} else {
		$.post("inc/ajax.php?funcao=login",
			{email: email, senha: senha},
			function(retorno){
				if(retorno == 1){
					window.location = "perfil";
				} else {
					alert("Login ou Senha inválidos!");
				}
			}
		)
	}
}

function cadastro(){
	
	var nome = $("#cadastro_nome").val();
	var sobrenome = $("#cadastro_sobrenome").val();
	var sexo = $("#cadastro_sexo").val();
	var nascimento = $("#cadastro_nascimento").val();
	var cidade = $("#cidade").val();
	var email = $("#cadastro_email").val();
	var cemail = $("#cadastro_cemail").val();
	var senha = $("#cadastro_senha").val();
	var csenha = $("#cadastro_csenha").val();
	
	if(nome == ""){
		alert("Preencha o campo Nome");
	} else if(sobrenome == ""){
		alert("Preencha o campo Sobrenome");
	} else if(sexo == ""){
		alert("Preencha o campo Sexo");
	} else if(nascimento == ""){
		alert("Preencha o campo Data de Nascimento");
	} else if(email == ""){
		alert("Preencha o campo E-mail");	
	} else if(cemail == ""){
		alert("Preencha o campo Confirmar E-mail");
	} else if(email !== cemail){
		alert("Os campos E-mail e Confirmar E-mail devem ser iguais");
	} else if(senha == ""){
		alert("Preencha o campo Senha");
	} else if(csenha == ""){
		alert("Preencha o campo Confirmar Senha");
	} else if(senha !== csenha){
		alert("Os campos Senha e Confirmar Senha devem ser iguais");
	} else {
		$.post("inc/ajax.php?funcao=cadastro",
			{nome: nome, sobrenome: sobrenome, sexo: sexo, nascimento: nascimento, cidade: cidade, email: email, senha: senha},
			function(retorno){	
				if(retorno){
					window.location = "perfil";
				} else {
					alert("Não foi possível cadastrar!");
				}
			}
		)
	} 
}

function verifica_email(email){
	var email = $("#cadastro_email").val();
	
	if(email != ""){
		$.post("inc/ajax.php?funcao=verifica_email",
			{email: email},
			function(retorno){
				if(retorno == 1){
					alert("E-mail ja cadastrado no banco");
					window.location = "";
				}
			}
		)
	}
}
function logoff(){
	$.post("inc/ajax.php?funcao=logoff",
		function(retorno){
			window.location = "rsocial.php";
		}
	)
}

function publicar(){
	var publicar = $("#publicar").val();

	if(publicar == ""){
		alert("Campo de publicação não pode ser vazio");
	} else {
		$.post("inc/ajax.php?funcao=publicar",
			{publicar: publicar},
			function(retorno){
				if(retorno){
					window.location = "perfil";
				} else {	
					alert("Não foi possível publicar, tente novamente.");
				}
			}
		)
	}	
}

var alterar = 0;
function editar_postagem(id_postagem, id_usuario){
	
	if(alterar == 1){
		postagem_alterada(id_postagem, id_usuario);
		alterar = 0;	
	} else {
		alterar = 1;
		document.getElementById("post_texto").disabled = false;
		$("#editar_postagem").html('Salvar');
	}
}


function postagem_alterada(id_postagem, id_usuario){
	var post_texto = $("#post_texto").val();
	
	if(post_texto == ""){
		alert("Campo de publicação não pode ser vazio");
	} else {
		$.post("inc/ajax.php?funcao=postagem_alterada",
			{id_postagem: id_postagem, post_texto: post_texto, id_usuario: id_usuario},
			function(retorno){	
				if(retorno){
					window.location = "perfil";
				} else {
					alert("Não foi possível alterar postagem!");
				}
			}
		)
	} 
}

function excluir_registro(tabela, id){
	$.post("inc/ajax.php?funcao=excluir_registro", 
		{tabela: tabela, id: id}, 
		function(retorno){
			window.location.reload();
		}
	)	
}

function editar_perfil(){
	document.getElementById("nome").disabled = false;  
	document.getElementById("sobrenome").disabled = false; 
	document.getElementById("sexo").disabled = false;  
	document.getElementById("dt_nascimento").disabled = false; 
	document.getElementById("email").disabled = false;  
	document.getElementById("relacionamento").disabled = false; 
	document.getElementById("escolaridade").disabled = false;  
	document.getElementById("estado").disabled = false; 
	document.getElementById("cidade").disabled = false; 
}

function salvar_perfil(){
	var id_usuario = $("#id_usuario").val();
	var nome = $("#nome").val();
	var sobrenome = $("#sobrenome").val();
	var sexo = $("#sexo").val();
	var nascimento = $("#dt_nascimento").val();
	var email = $("#email").val();
	var relacionamento = $("#relacionamento").val();
	var escolaridade = $("#escolaridade").val();
	var estado = $("#estado").val();
	var cidade = $("#cidade").val();
	
	if(nome == ""){
		alert("Preencha o campo Nome");
	} else if(sobrenome == ""){
		alert("Preencha o campo Sobrenome");
	} else if(sexo == ""){
		alert("Preencha o campo Sexo");
	} else if(nascimento == ""){
		alert("Preencha o campo Data de Nascimento");
	} else {
		$.post("inc/ajax.php?funcao=salvar_perfil",
			{id_usuario: id_usuario, nome: nome, sobrenome: sobrenome, sexo: sexo, nascimento: nascimento, email: email, 
			 relacionamento: relacionamento, escolaridade: escolaridade, estado: estado, cidade: cidade},
			function(retorno){	
				if(retorno){
					window.location = "editar_perfil";
				} else {
					alert("Não foi possível salvar!");
				}
			}
		)
	} 
}

function criar_album(){
	
	document.getElementById("nome_album").style.visibility = "visible";
	document.getElementById("inp_nome_album").style.display = "";
	document.getElementById("btn_salvar_album").style.display = "";
		
}

function salvar_album(){
	var album_nome = $("#inp_nome_album").val();
	var id_usuario = $("#id_usuario").val();
	
	if(album_nome == ""){
		alert("Informe o nome do album");	
	}
	
	$.post("inc/ajax.php?funcao=salvar_album", 
	{album_nome: album_nome, id_usuario: id_usuario}, 
	function(retorno){
		if(retorno){
			window.location = "album";
		} else {
			alert("Não foi possível salvar album");
		}
	})		
}	


function carregar_cidade(){
	var estado = $("#estado").val();
	alert(estado);
	$.post("inc/ajax.php?funcao=carregar_cidade", 
	{estado: estado}, 
	function(retorno){
		if(retorno){
			$("#cidade").html(retorno);
		} else {
			alert("Não foi possível carregar as cidades");
		}
	})		
}	

function adicionar_amigo(id_usuario){	
	$.post("inc/ajax.php?funcao=adicionar_amigo",
	{id_usuario: id_usuario},
	function(retorno){		
		if(retorno){
			window.location = "amigos";
		}else{
			alert("Amigo não adicionado");
		}
	})
		
}

function aceitar_amigo(ami_situacao){	
	$.post("inc/ajax.php?funcao=aceitar_amigo",
	{ami_situacao: 1},
	function(retorno){		
		if(retorno){
			window.location = "perfil";
		}else{
			alert("Amigo não aceito");
		}
	})
		
}

function recusar_amigo(id_amigo){	
	$.post("inc/ajax.php?funcao=recusar_amigo",
	{id_amigo: id_amigo},
	function(retorno){
		alert(retorno);
		if(retorno){
			window.location = "perfil";
		}else{
			alert("Amigo não aceito");
		}
	})	
}

function excluir_conta(id_usuario, id_album){
	alert(id_album);
	$.post("inc/ajax.php?funcao=excluir_conta",
	{id_usuario: id_usuario, id_album: id_album},
	function(retorno){
		alert(retorno);
		if(retorno){
			window.location = "";
		}else{
			alert("Não foi possivel excluir a conta");
		}
	})
	
	
}