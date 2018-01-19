<?php namespace DepotServer;

/**
 * DeSeRP
 *
 * Clase principal de todo el sistema
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2010
 * @name         DeSeRP
 * @since		0.1_beta
 * @version		3.0
 */
use DepotServer\Configuracion;
use DepotServer\Conexion;
use DepotServer\FileManager;

class DeSeRP{

	private $pagina, $encabezado, $contenido, $menu, $usuario, $d, $modo, $mods, $req, $browser;
	protected $filesystem;

	public function __construct($req){
		try{
			$this->req = $req;

			$_REQUEST = $req;

			$this->iniciarSistema();
			if( isset( $_SESSION['activa']) ){

				if($_SESSION['activa'] == true AND ($_SESSION['usuario']['area'][$req['b']] > 0 OR strlen($req['b'])==0 OR $req['b'] == 'principal')){
					$this->contenido = "";
					$req['b'] = strtolower($req['b']);
					$req['c'] = strtolower($req['c']);

					if($req['a']=='app' && file_exists("inc/".$req['b']."/tpl/".$req['c'].".tpl.php")){
						$this->modo="deserp";
						$this->menu = $this->obtenerArchivo("inc/principal/tpl/menu.tpl.php", true, array("urlActual" => $req['uri'],"menu" => $_SESSION['usuario']['menu']));
						//$this->menuizq = $this->obtenerArchivo("inc/principal/tpl/menuizq.tpl.php");
						if(file_exists("inc/".$req['b']."/ctl/".$req['c'].".ctl.php")){
							$this->contenido = $this->obtenerArchivo("inc/".$req['b']."/ctl/".$req['c'].".ctl.php");
						}
						$this->contenido .= $this->obtenerArchivo("inc/".$req['b']."/tpl/".$req['c'].".tpl.php", true);

					}else if($req['a']=='wsdl'){
						$this->modo = "wsdl";
						if(file_exists("inc/".$req['b']."/ctl/".$req['c'].".ctl.php")){
							$this->contenido = $this->obtenerArchivo("inc/".$req['b']."/ctl/".$req['c'].".ctl.php");
						}else{
							$this->contenido = "";
						}
					}else{
						$this->menu = $this->obtenerArchivo("inc/principal/tpl/menu.tpl.php", true, array("urlActual" => $req['uri'],"menu" => $_SESSION['usuario']['menu']) );
						$this->contenido = $this->obtenerArchivo("inc/principal/ctl/principal.ctl.php");
						$this->contenido .= $this->obtenerArchivo("inc/principal/tpl/principal.tpl.php", true);
					}
				}else if($_SESSION['activa'] == true){
					throw new \Exception("Usted no tiene permiso para entrar a esta &aacute;rea.");
				}
			}else{
				$this->establecerTitulo("Ingreso a DeSeRP");
				$this->contenido = $this->obtenerArchivo("inc/principal/ctl/login.ctl.php");
				$this->contenido .= $this->obtenerArchivo("inc/principal/tpl/login.tpl.php");

				$this->agregarScript('$("body").addClass("layout-top-nav"); $(".main-sidebar").remove(); $(".sidebar-toggle").replaceWith(\'<a href="/" class="navbar-brand">DeSeRP</a>\'); $(".logo").hide();');
			}
		}catch(\Exception $e){
			$this->establecerTitulo("Excepci&oacute;n");
			$this->contenido= $this->msgError("<p>".$e->getMessage()."</p><p><a href='javascript:history.back(1)'>Regresar</a></p><textarea class='hidden'>".print_r(debug_backtrace(),true)."</textarea>");
		}catch(Exception $e){
			$this->establecerTitulo("Excepci&oacute;n");
			$this->contenido= $this->msgError("<p>".$e->getMessage()."</p><p><a href='javascript:history.back(1)'>Regresar</a></p><textarea class='hidden'>".print_r(debug_backtrace(),true)."</textarea>");
		}

	}

	private function iniciarSistema(){
		$this->filesystem = new FileManager('../');
		$this->loader = new \Twig\Loader\FilesystemLoader('/');
		$this->twig = new \Twig\Environment($this->loader, array( 'cache' => 'tmp/cache', 'debug' => true ));

		$this->detectarBrowser();
		$this->cargarVariables();
		$config = new Configuracion();
		setlocale(LC_ALL, $config->locale);
		setlocale(LC_MONETARY, $config->locale);
		date_default_timezone_set($config->timezone);
	}

	public function obtenerArchivo($archivo, $cache = false, $vars = array() ){
		if(!$cache){
			ob_start();
			require_once($archivo);
			$info = ob_get_contents();
			ob_end_clean();
			return $info;
		}else{
			return $this->obtenerTemplate($archivo, $vars);
		}
	}

	private function obtenerTemplate($archivo, $vars = array() ){
		return $this->twig->load($archivo)->render( $vars );
	}

	private function prepararPagina(){

		$config = new Configuracion();
		$this->debug($config->debug);
		$this->contenido .= $this->cargarPlugins();
		if($this->modo != "wsdl"){
			$this->pagina = $this->obtenerArchivo("inc/principal/tpl/index.tpl.php", true, array("session" => $_SESSION));
		}else{
			$this->pagina = $this->contenido;
		}

		$this->pagina = preg_replace_callback( '/{@_([a-zA-Z0-9]+)}/', function ($s) { return $this->{$s[1]}; }, $this->pagina);
		$this->pagina = preg_replace_callback("/{@([a-zA-Z]+)\->([a-zA-Z0-9]+)}/", array( &$this, 'traducirD'), $this->pagina);
		$this->pagina = preg_replace_callback("/{@([a-zA-Z]+)\->([a-zA-Z0-9]+)}/", array( &$this, 'traducirD'), $this->pagina);

	}

	private function traducirD($m){
		return $this->d[$m[1]][$m[2]];
	}

	private function traducirS($m){
		return $this->{$m[1]};
	}

	public function __toString(){
		$this->prepararPagina();
		return $this->pagina;
	}

	public function agregarScript($script){
		$this->d['pag']['script'] .= $script;
	}

	public function agregarArchivoScript($archivo){
		$js = '<script type="text/javascript" src="'.$archivo.'"></script>';
		$this->d['pag']['js'] .= $js;
	}

	public function agregarCSS($archivo){
		$css = '<link rel="stylesheet" type="text/css" href="'.$archivo.'" />';
		$this->d['pag']['css'] .= $css;
	}

	public function formato($tipo, $valor){
		$tipo = strtoupper($tipo);
		switch($tipo){
			case "MONEDA":
				return money_format('%(#10n', $valor);
			break;

			case "FECHA":
				if($valor=="0000-00-00"){return "";}
				return date("d / m / Y",strtotime($valor));
			break;

			default:
				return $valor;
			break;
		}
	}

	public function establecerTitulo($titulo){ $this->d['pag']['titulo'] = $titulo; }

	public function establecerVariable($nombre,$valor){ $this->d['pag'][$nombre] = $valor; }
	public function ev($n,$v){$this->establecerVariable($n,$v);}

	public function msgError($msg, $btnCerrar = true){ return  "<div class='error alert alert-danger'>".$msg.($btnCerrar?"<button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'><span aria-hidden='true'>&times;</span></button>":"")."</div>";}
	public function msgAlerta($msg, $btnCerrar = true){return  "<div class='alerta alert alert-warning'>".$msg.($btnCerrar?"<button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'><span aria-hidden='true'>&times;</span></button>":"")."</div>";}
	public function msgInfo($msg, $btnCerrar = true){ return  "<div class='info alert alert-info'>".$msg.($btnCerrar?"<button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'><span aria-hidden='true'>&times;</span></button>":"")."</div>";}
	public function msgOk($msg, $btnCerrar = true){ return  "<div class='ok alert alert-success'>".$msg.($btnCerrar?"<button type='button' class='close' data-dismiss='alert' aria-label='Cerrar'><span aria-hidden='true'>&times;</span></button>":"")."</div>";}

	private function debug($habilitado){
		if($habilitado){
			ob_start();
			echo '<h1>Debug</h1><table border="1" width="100%"><tr> <th>variable</th> <th>valor</th> </tr>';
			foreach( array("D" => $this->d,"Sesión" => $_SESSION) as $key => $value){
			    if (is_array ($value) )
			    {
				echo '<tr><td>$'.$key .'</td><td>';
				if ( sizeof($value)>0 ){
					echo '<table border=1><tr> <th>variable</th> <th>valor</th> </tr>';
					foreach ($value as $skey => $svalue){
					    echo '<tr><td>[' . $skey .']</td><td>' ;
						if ( sizeof($svalue)>0 && is_array($svalue)){
							echo '<table border=1><tr> <th>variable</th> <th>valor</th> </tr>';
							foreach ($svalue as $sskey => $ssvalue){
								echo '<tr><td>[' . $sskey .']</td><td>';
								if(sizeof($ssvalue)>0){
									echo "<pre>";
									print_r($ssvalue);
									echo "</pre>";
								}else{
									echo '"'.$ssvalue.'"';
								}
								echo '</td></tr>';
							}
							echo '</table>';
						}else{
							echo '"'.$svalue.'"';
						}
						echo '</td></tr>';
					}
					echo '</table>';
				}else{
				    echo 'VACIO';
				}
				echo '</td></tr>';
			    }else{
				    echo '<tr><td>$' . $key .'</td><td>"'. $value .'"</td></tr>';
			    }
			}
			echo '</table>';
			echo "URL : <br />a : ".$_REQUEST['a'].", b : ".$_REQUEST['b'].", c : ".$_REQUEST['c'];

			$vars .= ob_get_contents();
			ob_end_clean();
			$this->contenido .= $this->msgInfo($vars);
		}
	}

	private function cargarVariables(){
		$this->obtenerArchivo("inc/principal/idm/comun.idm.php");
		$_SESSION['d'] = $this->d;
	}

	private function cargarPlugins(){
		if(is_dir('classes/plugins')){
			if ($handle = opendir('classes/plugins')) {
				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != ".." && substr($file, -10, 10) == ".class.php") {
						$m = substr($file, 0, (strlen($file)-10));
						$this->mod[] = $m;
						require_once("classes/plugins/".$m.".class.php");
						eval("\$cm = new $m();");
					}
				}
				closedir($handle);
			}
		}
	}

	public function os($var){
		return $this->obtenerSolicitud($var);
	}
	public function obtenerSolicitud($var){
		switch($var){
			case 1: $v = 'a'; break;
			case 2: $v = 'b'; break;
			case 3: $v = 'c'; break;
			case 4: $v = 'd'; break;
			case 5: $v = 'e'; break;
			case 6: $v = 'f'; break;
			case 7: $v = 'g'; break;
			case 8: $v = 'h'; break;
			case 9: $v = 'i'; break;
			case 10: $v = 'j'; break;
			case 11: $v = 'k'; break;
			default: $v =''; break;
		}
		return $this->req[$v];
	}

	private function detectarBrowser(){
		if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])){
			//$this->browser = "mobile";
			$this->browser = "NOmobiel";
		}else{
			$this->browser = "pc";
			//$this->browser = "mobile";
		}
	}

	public function generarMenu($modulos){
		$menu = array();
		foreach ($modulos as $modulo) {
			$archivo = "inc/".$modulo."/data.json";
			if ( $this->filesystem->existeArchivo($archivo) ){
				$menu[] = json_decode($this->filesystem->leerArchivo($archivo), true);
			}
		}
		return $menu;
	}

	public function agregarRegistro($accion, $idUsuario = 0){
		if($idUsuario == 0){
			$idUsuario = $_SESSION['usuario']['id'];
		}
		$db = new BaseDatos();
		$db::table("accesos")->insert( [ 'idUsuario' => $idUsuario, 'area' => $accion, 'fecha' => date("Y-m-d H:i:s") ] );
	}
}
