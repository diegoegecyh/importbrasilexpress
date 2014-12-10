<?
	$sql = "SELECT *
			FROM produto
			INNER JOIN produto_imagem USING(id_produto)
			GROUP BY produto.id_produto
			ORDER BY RAND()
			LIMIT 0,9";
	carregar_produto($sql);
?>