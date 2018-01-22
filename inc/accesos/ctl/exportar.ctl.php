<?php
function cleanData(&$str)
{
 $str = utf8_decode($str);
 $str = preg_replace("/\t/", "\\t", $str);
 $str = preg_replace("/\r?\n/", "\\n", $str);
 if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
$filename = "Registros_accesos_" . date('Y_m_d') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel; charset=utf-8");

$flag = false;
$c = new DepotServer\BaseDatos();
$result = $c::table('accesos')->leftJoin('usuarios', 'usuarios.id', '=', $tabla.'.idUsuario')->select( $c::raw('accesos.*, usuarios.usuario, usuarios.nombre') )->get()->all(); 

foreach ($result as $row) {
	$row = get_object_vars($row);
	if(!$flag) {
		echo implode("\t", array_keys($row)) . "\r\n";
		$flag = true;
	}
	array_walk($row, 'cleanData');
	echo implode("\t", array_values($row))  . "\r\n";
}
exit;
?>
