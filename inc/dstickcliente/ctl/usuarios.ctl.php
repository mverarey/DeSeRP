<?php
$bd = new DepotServer\BaseDatos();
$idCliente = $this->os(4);

$tblcliente = $bd::table("dstick_cliente")->where("id", $idCliente)->first();
if(empty((array)$tblcliente)){ throw new Exception("Cliente no válido"); }

if( isset( $_REQUEST['nivel']) ){
	
}

$tblusuariosCliente = $bd::table("dstick_cliente_usuario")
				->select('usuarios.id', 'usuarios.nombre', 'dstick_cliente_usuario.nivel')
				->leftJoin('usuarios', 'usuarios.id', '=', 'dstick_cliente_usuario.idUsuario')
            	->where("idCliente", $idCliente)->get()->all();

$usuariosXnivel = [];
$jsUsuarios = "";
foreach($tblusuariosCliente as $usuario){
	$usuariosXnivel[$usuario->nivel][] = [ "id" => $usuario->id, "nombre" => $usuario->nombre ];
}
$usuariosJson = json_encode($usuariosXnivel);
$this->establecerTitulo("Usuarios de ".$tblcliente->nombre);

$script = <<<EOM
var relaciones = $usuariosJson;
// console.log(relaciones);
for(var nivel in relaciones) {
	var niv = $('#nivel'+ nivel);
	for(var usuario in relaciones[nivel]){
		var option = new Option(relaciones[nivel][usuario].nombre, relaciones[nivel][usuario].id, true, true);
	    niv.append(option);
	}
	niv.trigger('change');
}
$('.js-data').select2({ ajax: { url: '/json/usuarios', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "campos": "YToxOntpOjA7czo2OiJub21icmUiO30" }; return query; } }, language: "es" });	

EOM;
$this->agregarScript($script);
