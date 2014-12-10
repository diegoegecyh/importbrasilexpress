function excluir_registro(tabela, id){
	$.post(raiz+"?funcao=excluir_registro",
		{tabela: tabela, id: id},
		function(retorno){
			alert(retorno);
			window.location.reload();
		}
	)
}

function editar_registro(id){
	$("#editar_registro").val(id);
	$("#form_editar").submit();
}