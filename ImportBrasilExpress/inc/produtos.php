<div class="panel panel-default col-md-12 col-lg-12" > 
    <div class="row panel-heading">
        <h3 class="panel-title" style="color:#3299FF;">Destaques</h3>
    </div>
    <div class="panel-body">
        <div class="produto_destaque">
            <?
                $mysqli = new MySQLi("localhost","root","root","importbrasilexpress");
                $sql = "SELECT *
                          FROM produto
                          INNER JOIN produto_imagem USING(id_produto)
                          GROUP BY produto.id_produto
                          ORDER BY RAND()
                          LIMIT 0,6";
                $res = mysqli_query($mysqli, $sql);		
                while($row=mysqli_fetch_assoc($res)){
            ?>
                    <div class="row panel panel-default col-md-3 col-lg-3" style="margin-left:80px;">
                    	<div class="panel-body">
                            <h4><?=utf8_encode($row['pro_descricao'])?></h4>
                            <div class="col-md-8 col-lg-8">
                                <img class="img-responsive" src="img/<?=$row['img_caminho']?>" />
                            </div>
                            <span class="col-md-8 col-lg-8" style="font-size:16px;">Valor</span><br />
                            <span class="valor_original col-md-6 col-lg-6" style="font-size:16px;">R$ <?=$row['pro_valor']?></span>
                            <br />
                            <button id="comprar" type="button" class="btn btn-primary col-md-6 col-lg-6"> Comprar</button>
                        </div>
                    </div>
            <?
                }
            ?>
        </div>
    </div>
</div> 