function mostrar_categoria(id){
	$(".subcategoria a").css("display", "none");
	$("#categoria_"+id+" a").css("display", "block");
}

function cadastro(){
	var nome = $("#cadastro_nome").val();
	var email = $("#cadastro_email").val();
	var senha = $("#cadastro_senha").val();
	
	if(nome == ""){
		alert("Preencha o campo nome");
	} else if(email == ""){
		alert("Preencha o campo e-mail");
	} else if(senha == ""){
		alert("Preencha o campo senha");
	} else {
		$.post("inc/ajax.php?funcao=cadastro",
			{nome: nome, email: email, senha: senha},
			function(retorno){
				if(retorno){
					window.location = $("#destino").val();
				} else {
					alert("Não foi possível cadastrar!");
				}
			}
		)
	}
}

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
				if(retorno){
					window.location = $("#destino").val();
				} else {
					alert("Login ou Senha inválidos!");
				}
			}
		)
	}
}


function logoff(){
	$.post("inc/ajax.php?funcao=logoff",
		function(retorno){
			window.location.reload();
		}
	)
}

function adicionarProduto(id){
	$.post("inc/ajax.php?funcao=adicionarProduto",
		{id: id},
		function(retorno){
			if(retorno){
				alert(retorno);
			} else {
				window.location = "carrinho";
			}
		}
	)
}

function excluirProduto(id){
	$.post("inc/ajax.php?funcao=excluirProduto",
		{id: id},
		function(retorno){
			window.location = "carrinho";
		}
	)
}

function alterarQtd(id){
	var qtd = $("#qtd_"+id).val();
	
	if(qtd > 0){
		$.post("inc/ajax.php?funcao=alterarQtd",
			{id: id, qtd: qtd},
			function(retorno){
				if(retorno){
					alert(retorno);
				} else {
					window.location = "carrinho";
				}
			}
		)
	} else {
		alert("Informe um valor numérico!");
	}
}



function finalizarPedido(){
	var pagamento = $(".pagamento:checked").val();
	var entrega = $(".entrega:checked").val();

	if(pagamento){
		$.post("inc/ajax.php?funcao=finalizarPedido",
			{pagamento: pagamento, entrega: entrega},
			function(retorno){
				window.location = "pedido-finalizado";
			}
		)
	} else {
		alert("Selecione uma forma de pagamento!");
	}
}


