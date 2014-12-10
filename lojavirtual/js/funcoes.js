function mostrar_marca(id){
	$(".categoria a").css("display", "none");
	$("#marca_"+id+" a").css("display", "block");
	$(".subcategoria a").css("display", "none");
}

function mostrar_categoria(id_cat, id_marca){
	$("#marca_"+id_marca+" a").css("display", "block");	
	$(".subcategoria a").css("display", "none");
	$("#categoria_"+id_cat+" a").css("display", "block");
	
}
function getEndereco(cep) {
	if(cep == ""){
		alert("Informe o CEP para realizar a pesquisa");	
	}else if($.trim(cep) != ""){
		$("#loadingCep").html('Pesquisando...');
		$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){            
			if (resultadoCEP["resultado"] != 0) {
				$("#cadastro_inp_cidade").val(unescape(resultadoCEP["cidade"]));
				$("#cadastro_inp_estado").val(unescape(resultadoCEP["uf"]));
				$("#cadastro_inp_rua").val(unescape(resultadoCEP["logradouro"]))
				$("#cadastro_inp_bairro").val(unescape(resultadoCEP["bairro"]))
			}else{
				alert("Ocorreu um erro na verificação do CEP, por favor verifique se está correto");                
			}            
		});
    }else{
        $("#loadingCep").html('Informe o CEP');
    }
}
/*
function IsNum(v){
   var ValidChars = "0123456789()-";
   var IsNumber=true;
   var Char;

   for (i = 0; i < v.length && IsNumber == true; i++){ 
      Char = v.charAt(i); 
      if(ValidChars.indexOf(Char) == -1){
         IsNumber = false;
      }
   }
   
   return IsNumber;
}
*/
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
					window.location = "";
				} else {
					alert("Login ou Senha inválidos!");
				}
			}
		)
	}
}

function validaData(valor) {
	var date=valor;
	var ardt=new Array;
	var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt=date.split("/");
	erro=false;
	if ( date.search(ExpReg)==-1){
		erro = true;
		}
	else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
		erro = true;
	else if ( ardt[1]==2) {
		if ((ardt[0]>28)&&((ardt[2]%4)!=0))
			erro = true;
		if ((ardt[0]>29)&&((ardt[2]%4)==0))
			erro = true;
	}
	if (erro){
		return true;
	}
}

var filtro_mail = /^.+@.+\..{2,3}$/;
function cadastro(){

	/*Dados cadastrais do usuario*/
	var nome = $("#cadastro_inp_nome").val();
	var apelido = $("#cadastro_inp_apelido").val();
	var cpf = $("#cadastro_inp_cpf").val();
	var rg = $("#cadastro_inp_rg").val();
	var sexo = $("#cadastro_inp_sexo").val();
	var nascimento = $("#cadastro_inp_nascimento").val();
	var tel_pre = $("#cadastro_inp_telefonePrerencial").val();
	var tel_res = $("#cadastro_inp_telefoneResidencial").val();
	var tel_cel = $("#cadastro_inp_telefoneCelular").val();
	var email = $("#cadastro_inp_email").val();
	var cemail = $("#cadastro_inp_cemail").val();
	var senha = $("#cadastro_inp_senha").val();
	var csenha = $("#cadastro_inp_csenha").val();

	/*Dados de endereço do usuario*/
	var cep = $("#cadastro_inp_cep").val();
	var estado = $("#cadastro_inp_estado").val();
	var cidade = $("#cadastro_inp_cidade").val();
	var bairro = $("#cadastro_inp_bairro").val();
	var rua = $("#cadastro_inp_rua").val();
	var numero = $("#cadastro_inp_numero").val();
	var complemento = $("#cadastro_inp_complemento").val();
	
	/*Verificação dos dados cadastrais do usuario*/
	if(nome == ""){
		alert("Preencha o campo Nome");
		$("#cadastro_inp_nome").focus();
	} else if(cpf == ""){
		alert("Preencha o campo CPF");
		$("#cadastro_inp_cpf").focus();
	} else if(rg == ""){
		alert("Preencha o campo RG");
		$("#cadastro_inp_rg").focus();
	} else if(validaData(nascimento)){
		alert("A Data de Nascimento informada não é uma data válida");
		$("#cadastro_inp_nascimento").focus();
	} else if(sexo == ""){
		alert("Preencha o campo Sexo");
		$("#cadastro_inp_sexo").focus();
	}else if(tel_pre == "" && tel_res == "" && tel_cel == "" ){
		alert("Informe ao menos um telefone para contato");
	} else if(!filtro_mail.test(email) || email==""){
		alert("E-mail informado é invalido");
		$("#cadastro_inp_email").focus();
	} else if(!filtro_mail.test(cemail) || cemail==""){
		alert("E-mail informado é invalido");
		$("#cadastro_inp_cemail").focus();
	} else if(email !== cemail){
		alert("Os campos E-mail e Confirmar E-mail devem ser iguais");
		$("#cadastro_inp_email").focus();
	} else if(senha == ""){
		alert("Preencha o campo Senha");
		$("#cadastro_inp_senha").focus();
	} else if(csenha == ""){
		alert("Preencha o campo Confirmar Senha");
		$("#cadastro_inp_csenha").focus();
	} else if(senha !== csenha){
		alert("Os campos Senha e Confirmar Senha devem ser iguais");
		$("#cadastro_inp_senha").focus();
	/*Verificação dos dados do endereço do usuario*/
	} else if(cep == ""){
		alert("Preencha o campo Cep");
		$("#cadastro_inp_cep").focus();
	} else if(numero == ""){
		alert("Preencha o campo Numero");
	} else {
		$.post("inc/ajax.php?funcao=cadastro",
			{nome: nome, apelido: apelido, cpf: cpf, rg: rg, sexo: sexo, nascimento: nascimento, tel_pre: tel_pre, tel_res: tel_res, tel_cel: tel_cel,
			 email: email, senha: senha, cep: cep, estado: estado, cidade: cidade, 
			 bairro: bairro, rua: rua, numero: numero, complemento: complemento},
			function(retorno){	
				if(retorno){
					window.location = "";
				} else {
					alert("Não foi possível se cadastrar, tente novamente mais tarde");
				}
			}
		)
	} 
}

function logoff(){
	$.post("inc/ajax.php?funcao=logoff",
		function(retorno){
			window.location = "lojavirtual.php";
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