<?
$db = new DepotServer\BaseDatos();
if(isset($this->req['m'])){
	$msg = "<p>Permisos anteriores borrados!";
	$reg_aft = $db::table("usuarios_permisos")->where("idUsuario",$this->os(4) )->delete();
	$i = 0;
	foreach($this->req['m'] as $mod => $detalles){
		if(sizeof($detalles)>1){
			$db::table("usuarios_permisos")->insert( [ 'idUsuario' => $this->os(4), 'modulo' => $mod, 'nivel' => $detalles['niv'] ] );
			$i++;
		}
	}
	echo $this->msgInfo($msg."<br/>Nuevos permisos a&ntilde;adidos exit&oacute;samente.<br/><span style='font-size:90%;'>Total: ".abs($reg_aft-$i)."</span></p>");
}

$sql = $db::table("usuarios")->join('usuarios_permisos', 'usuarios_permisos.idUsuario', '=', 'usuarios.id')->select()->where("usuarios.id", $this->os(4))->get()->all();
$fila = get_object_vars($sql[0]);
$this->establecerTitulo("Modificar permisos de ".$fila['nombre']." ");
$this->ev("usuario",$fila['nombre']);
if ($handle = opendir('inc/')) {
    while (false !== ($file = readdir($handle))) {	
        if (!preg_match("/\./", $file)) {
            $modulos_usuario[$file] = array(0,0);
        }
    }
    closedir($handle);
}
foreach ($sql as $fila) {
	$fila = get_object_vars($fila);
	$modulos_usuario[$fila['modulo']] = array(1,$fila['nivel']);
}
unset($modulos_usuario['principal']);
unset($modulos_usuario['']);
ksort($modulos_usuario);

$tabla = "";
foreach($modulos_usuario as $nom => $modulo){
	$tabla .= '<tr><td align="center" style="text-align:center;" class="lead">'.$nom.'</td>
				<td>
				<div class="input-group">
				  <span class="input-group-addon">
					<input type="checkbox" name="m['.$nom.'][a]" '.($modulo[0]==1?"checked":"").' />
				  </span>
				  <select class="form-control" name="m['.$nom.'][niv]"><option value="0" '.($modulo[1]==0?"selected":"").' >Sin acceso</option><option value="1" '.($modulo[1]==1?"selected":"").' >Ver</option><option value="2" '.($modulo[1]==2?"selected":"").' >Crear</option><option value="3" '.($modulo[1]==3?"selected":"").' >Administrar</option></select>
				</div>
				</td></tr>';
}
$this->ev("permisos",$tabla);
?>