<?
function cleanData(&$str) 
{ 
 $str = utf8_decode($str);
 $str = preg_replace("/\t/", "\\t", $str); 
 $str = preg_replace("/\r?\n/", "\\n", $str); 
 if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

// filename for download 
$filename = "Registros_test_formbuilder_" . date('Y_m_d') . ".xls"; 

header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1"); 

$flag = false;
$c = new Conexion();

$result = $c->query('SELECT * FROM test_formbuilder'); 
while(false !== ($row = mysql_fetch_assoc($result))) {

	if(!$flag) { 
		// display field/column names as first row 
		echo implode("\t", array_keys($row)) . "\r\n"; 
		$flag = true; 
	} 
	array_walk($row, 'cleanData'); 
	echo implode("\t", array_values($row))  . "\r\n"; 
}

exit; 
?>