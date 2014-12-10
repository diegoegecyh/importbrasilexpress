<?
if($_POST){
		
	$str = "";
	for($i=0; $i<count($_POST); $i++){
		$aux = each($_POST);
		if($aux['value'] != ""){
			$str .= $aux['key']."='".$aux['value']."', ";
		}
	}
	$str = substr($str,0,-2);
	
	extract($_POST);
	
	if(isset($_POST['editar_registro'])){
		$sql = "SELECT *
				FROM $tabela
				WHERE id_$tabela = $editar_registro";
		$res = mysql_query($sql);
		$row = mysql_fetch_assoc($res);
	} else if($_POST['id_'.$tabela]) {
		$sql = "UPDATE $tabela SET $str
				WHERE id_$tabela = ".$_POST['id_'.$tabela];
		if(mysql_query($sql)){		
			header("Location: $raiz".$_GET['p']);	
		} else {
			echo "Não foi possível alterar!";
		}
	} else {
		echo $sql = "INSERT INTO $tabela SET $str";
		if(mysql_query($sql)){
			//header("Location: $raiz".$_GET['p']);
		} else {
			echo "Não foi possível cadastrar!";
		}
	}
}

function carregar_select($tabela, $campo, $id){
	
	$sql = "SELECT * FROM $tabela";
	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
		$chk = $id==$row['id_'.$tabela] ? "selected" : "";
		echo '<option '.$chk.' value="'.$row['id_'.$tabela].'">
			'.$row[$campo].'</option>';
	}
}



?>