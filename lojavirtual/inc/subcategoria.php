<?
	$subcategoria = $_GET['subcategoria'];
	$sql = "SELECT *
			FROM produto
			INNER JOIN produto_imagem USING(id_produto)
			WHERE id_subcategoria = $subcategoria
			GROUP BY produto.id_produto";
	carregar_produto($sql);
?>