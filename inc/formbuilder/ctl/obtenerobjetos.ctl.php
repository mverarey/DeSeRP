<?
if($_REQUEST['d'] > 0){
	$c = new Conexion();
	$campos = array();
	$res = $c->query("SELECT * FROM test_formbuilder WHERE id = ".$_REQUEST['d']." LIMIT 1");
	if($c->cantidad($res) > 0){
		$fila = mysql_fetch_assoc($res);
		/*foreach($fila as $col => $campo){
			$campos[$col] = utf8_encode($campo);
		}*/
		$campos = $fila;
	}
	echo json_encode($campos);
}
?>