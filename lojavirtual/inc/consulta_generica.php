<?

	function carregar_select($tabela, $campo, $id){
		$sql = "SELECT * FROM $tabela order by $campo";
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res)){
			$chk = $id==$row['id_'.$tabela] ?  "selected" : "";
			echo'<option '.$chk.' value="'.$row['id_'.$tabela].'">'.$row[$campo].'</option>';
		}
	}
	
?>