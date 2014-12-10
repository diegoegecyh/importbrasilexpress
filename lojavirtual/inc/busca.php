<?
	$busca = $_POST['busca'];
	$where = " pro_descricao like '%$busca%' or pro_detalhe like '%$busca%' ";
	$sql = "SELECT *
			FROM produto
			INNER JOIN produto_imagem USING(id_produto)
			WHERE $where
			GROUP BY produto.id_produto";
	carregar_produto($sql);
?>