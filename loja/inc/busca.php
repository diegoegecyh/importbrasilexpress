<?
	$busca = $_POST['busca'];
	$where = " descricao like '%$busca%' or detalhe like '%$busca%' ";
	$sql = "SELECT *
			FROM produto
			INNER JOIN produto_imagem USING(id_produto)
			WHERE $where
			GROUP BY produto.id_produto";
	carregar_produto($sql);
?>