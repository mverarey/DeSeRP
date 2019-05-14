<?php namespace DepotServer;
use \Imagine\Image\Box;
use PhpOffice\PhpSpreadsheet\Chart\Exception;

$this->establecerTitulo("Datos de mi usuario");

$db = new BaseDatos();

if(strlen($this->req['nombre']) > 0){

	$id = $_SESSION['usuario']['id'];
	$nombre = $this->req['nombre'];
	$email = $this->req['email'];
	$servidor = $this->req['servidor'];
	$password = base64_encode($this->req['passmail']);
	$tema = $this->req['tema'];

	$res = $db::table("usuarios")->where('id', $id)->update(["nombre" => $nombre, "email" => $email, "servidorSMTP" => $servidor, "passwordSMTP" => $password, "tema" => $tema]);

	if($res){

		$_SESSION['usuario']['nombre'] = $nombre;
		$_SESSION['usuario']['email'] = $email;
		$_SESSION['usuario']['tema'] = $tema;

		echo $this->msgOK("Cambios realizados exitosamente!");
		$this->agregarRegistro("Modificaste tu perfíl.");
	}

	if(strlen($this->req['password']) > 0){
		$res = $db::table("usuarios")->where('id', $id)->update([ "password" => md5($this->req['password']) ]);
		if($res){
			echo $this->msgOK("Cambio de contrase&ntilde;a realizado exitosamente!");
			$this->agregarRegistro("Modificaste tu contrase&ntilde;a.");
		}else{
			echo $this->msgError("No se realizó el cambio de contrase&ntilde;a!");
		}
	}
}

if(strlen($_FILES['file']['name']) > 0){

	$stream = fopen($_FILES['file']['tmp_name'], 'r+');
	$archivo = 'perfil_'.md5('perfil_'.$_SESSION['usuario']['id']);
	$path = 'tmp/imgs/';

	$imagine = new \Imagine\Gd\Imagine();
	try{
		$img = $imagine->open($_FILES['file']['tmp_name']);
		$this->filesystem->escribirArchivo( $archivo.'_thumb.jpg', $img->thumbnail(new Box(140, 140), \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)->get('jpg'),  $path, true);
		$this->filesystem->escribirArchivo( $archivo.'.jpg', $img->get('jpg'), $path, true);
		if( $this->filesystem->existeArchivo($path.$archivo.'.jpg') ){
			$_SESSION['usuario']['imagen'] = '/'.$path.$archivo.'_thumb.jpg';
			http_response_code (200);
			$output['ok'] = "Cargado";
		}else{
			http_response_code (401);
			$output['error'] = 'Ocurrió un error';
		}
	}catch(\Exception $e){
		http_response_code (401);
		$output['error'] = 'Ocurrió un error. '.$e->getMessage();
	}
	fclose($stream);
	header( 'Content-Type: application/json; charset=utf-8' );
	echo json_encode( $output );
	exit;
}

$usuario = $db::table("usuarios")->whereRaw('md5(id) = "'.md5($_SESSION['usuario']['id']).'"')->get()->first();
if(!$usuario){
	throw new Exception("Usuario no válido.");
}
$this->ev("id", $usuario->id);
$this->ev("nombre", $usuario->nombre);
$this->ev("usuario", $usuario->usuario);
$this->ev("email", $usuario->email);
$this->ev("servidor", $usuario->servidorSMTP);
$this->ev("passmail", base64_decode($usuario->passwordSMTP));
$this->ev("temaPred", "selected");
$this->ev("fotoperfil", $_SESSION['usuario']['imagen']);

$this->agregarArchivoScript("/assets/dropzonejs/dist/dropzone.js");
$this->agregarCSS("/assets/dropzonejs/dist/dropzone.css");

$scr = <<<Script
	//$("#frm").validate();
	$(".passt").click(function(){
		$(".password").removeAttr("disabled");
		$(".rpassword").removeAttr("disabled");
	});

	$("#btnFoto").click(function(){
		$(".perfilActual").hide();
		$("#frmFoto").show().removeClass("hidden");
	});

	$("#txttema").val("{$_SESSION['usuario']['tema']}");
Script;
$this->agregarScript($scr);

$historial = "";
$accesos = $db::table("accesos")->select("area", "fecha")->where('idUsuario', $_SESSION['usuario']['id'])->orderBy('fecha', 'desc')->get()->all();

$ultimaFecha = "";
foreach ($accesos as $key => $acceso) {
	$dia = date("d/m/Y", strtotime($acceso->fecha));
	if($ultimaFecha <> $dia){
		$historial .= '<!-- timeline time label -->
		<li class="time-label">
					<span class="bg-red">
						'.$dia.'
					</span>
		</li>
		<!-- /.timeline-label -->';
		$ultimaFecha = $dia;
	}
	$hora = date("H:i", strtotime($acceso->fecha));
	$historial .= <<<EOM
	<!-- timeline item -->
	<li>
		<i class="fa fa-star bg-blue"></i>
		<div class="timeline-item">
			<span class="time"><i class="fa fa-clock-o"></i> {$hora}</span>
			<h3 class="timeline-header no-border">{$acceso->area}</h3>
		</div>
	</li>
	<!-- END timeline item -->
EOM;

}

$this->ev("historial", $historial);

?>

<?


function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 segundos';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'año',
                 30 * 24 * 60 * 60  =>  'mes',
                      24 * 60 * 60  =>  'día',
                           60 * 60  =>  'hora',
                                60  =>  'minuto',
                                 1  =>  'segundo'
                );
    $a_plural = array( 'año'   => 'años',
                       'mes'  => 'meses',
                       'día'    => 'días',
                       'hora'   => 'horas',
                       'minuto' => 'minutos',
                       'segundo' => 'segundos'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? ' hace' . $a_plural[$str] : $str);
        }
    }
}
?>
