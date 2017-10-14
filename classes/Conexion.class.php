<?php namespace DepotServer;

use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Conexion
 *
 * Clase manipuladora de toda la información que pasa desde y hacia la base de datos.
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2010
 * @name         DeSeRP
 * @class		 Conexion
 * @since		0.1_beta
 * @version		2.5
 */
class Conexion{

	/**
    * Variable principal
	* @access private
    * @var Conexion contiene toda la conexión hacia el servidor
    */
	private $con;
	
	/**
    * Si la base de datos seleccionada es correcta regresa true.
	* @access private
    * @var bool
    */
	private	$base;

	/**
    * Ruta hacia la base de datos
	* @access private
    * @var string
    */	
	private $servidor;
	
	/**
    * Nombre del usuario de la base de datos
	* @access private
    * @var string
    */
	private $usuario;
	
	/**
    * Contraseña del usuario de la base de datos
	* @access private
    * @var string
    */
	private $password;
	
	/**
    * Nombre de la base de datos
	* @access private
    * @var string
    */
	private $db;
	
	/**
    * Resultado de la consulta
	* @access private
    * @var array
    */
	private$res;

	/**
    * Consulta
	* @access private
    * @var string
    */
	public $sql;

	/*
	 * Constructor
	 * 
	 * Inicializa la conexión a la base de datos.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	__construct
	 * @package	DeSeRP
	 * @version	0.1
	 * @since	0.1
	 * @param	string $servidor Nombre del servidor
	 * @param	string $usuario Nombre del usuario
	 * @param	string $password Contraseña de ingreso
	 * @param	string $db Nombre de la base de datos
	 */
	public function __construct($servidor = '', $usuario = '', $password = '', $db = ''){

		$this->con = new Capsule;

		if(strlen($servidor)>0 && strlen($usuario)>0){
			$this->servidor = $servidor;
			$this->usuario = $usuario;
			$this->password = $password;
			$this->db = $db;
			$this->conectar();
		}else{
			$c = new Configuracion;
			$this->servidor = $c->servidor;
			$this->usuario = $c->usuario;
			$this->password = $c->password;
			$this->db = $c->db;
			$this->conectar();
		}


	}
	
	public function obtenerTablas(){
		return mysql_list_tables($this->db);
	}

	/*
	 * conectar
	 * 
	 * Esta function conecta el sistema con la base de datos
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	conectar
	 * @package	DeSeRP
	 * @version	0.1
	 * @since	0.1
	 */
	private function conectar(){
		/*
		@$this->con = mysql_connect($this->servidor, $this->usuario, $this->password, false, 65536);
		if(!$this->con){ 
			throw new Exception("Base de datos - Conexi&oacute;n: Error");
			exit;
		}
		$this->base = mysql_select_db($this->db, $this->con);
		if(!$this->base){ 
			throw new Exception("Base de datos - BD: Error");
		}
		*/
		$this->con->addConnection([
		    'driver'    => 'mysql',
		    'host'      => $this->servidor,
		    'database'  => $this->db,
		    'username'  => $this->usuario,
		    'password'  => $this->password,
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => '',
		]);
		$this->con->setAsGlobal();

	}
/*
	public function __wakeup(){
		$this->conectar();
	}
*/

	/*
	 * query
	 * 
	 * Esta function realiza la consulta en la base de datos.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	query
	 * @package	DeSeRP
	 * @return	int
	 * @version	0.1
	 * @since	0.1
	 * @param	string $sql Consulta a realizarse
	 */
	public function query($sql){
		$this->sql = $sql;
		$res = $this->con::select($this->con::raw( $sql ) );
		//$res = mysql_query($sql,$this->con);
		//print_r($res);
		if($res){
			$this->res = $res;
			return $res;
		}else{
			return false;
		}
		
	}
	
	/*
	 * call SP
	 * 
	 * Esta function realiza una llamada a un Stored Procedure.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	query
	 * @package	DeSeRP
	 * @return	int
	 * @version	0.1
	 * @since	1.8
	 * @param	string $sp Stored Procedure
	 * @param	array $datos Datos a enviar
	 */
	public function call($sp, $datos){
		$res = "call ".$sp."(";
		foreach($datos as $dato){ $s .= '"'.$dato.'",'; } $res .= substr($s,0,-1);
		$res .= ")";
		return mysql_query($res,$this->con);		
	}
	
	/*
	 * borrar
	 * 
	 * Esta function borra los datos de la tabla.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	borrar
	 * @package	DeSeRP
	 * @return	int
	 * @version	0.2
	 * @since	0.2
	 * @param	string $tabla Nombre de la tabla
	 * @param	array|string $rest Condiciones para borrar un dato
	 * @param	bool $permiso Ignorar los permisos asignados y realizar la acci�n
	 */
	public function borrar($tabla, $rest = array ("",""), $permiso = false){
		if( $_SESSION['usuario']['area'][$_REQUEST['b']] >= 3 || $permiso){
			$sql = "DELETE FROM ".$tabla;
			if($rest[0] != ""){
				$sql .= " WHERE ".$rest[0]." = ".$rest[1];
			}
			$this->res = $this->query($sql);
			return mysql_affected_rows($this->con);
		}else{
			echo "<div class='error'>Usted no tiene los permisos necesarios para poder borrar datos.</div>";
			return false;
		}
	}
	
	/*
	 * actualizar
	 * 
	 * Esta function actualiza los datos en la tabla.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	actualizar
	 * @package	DeSeRP
	 * @return	int
	 * @version	0.4
	 * @since	0.4
	 * @param	string $tabla Nombre de la tabla
	 * @param 	array|string $arr_datos Arreglo con los datos a insertar
	 * @param	bool $permiso Ignorar los permisos asignados y realizar la accion
	 */
	public function actualizar($tabla, $arr_datos, $id, $permiso = false){
        		if( $_SESSION['usuario']['area'][$_REQUEST['b']] >= 2 || $permiso){
			if(sizeof($arr_datos)> 0 && is_array($arr_datos) ){
				/*$a = array_keys($arr_datos);
				$datos = $a[0]." = \"".$this->ec($arr_datos[$a[0]])."\"";
				foreach($arr_datos as $columna => $valor){$datos .= ", ".$columna." = \"".$this->ec($valor)."\" ";}			
				if(!is_array($id)){
					$sql = "UPDATE ".$tabla." SET ".$datos." WHERE id = ".$id;
				}else{
					$sql = "UPDATE ".$tabla." SET ".$datos." WHERE ".$id[0]." = ".$id[1];
				}
				$this->res = $this->query($sql);
				return mysql_affected_rows($this->con);
				*/
				if(!is_array($id)){
					$res = $this->con::table($tabla)->where('id', $id)->update($arr_datos);
				}else{
					$res = $this->con::table($tabla)->where($id[0], $id[1])->update($arr_datos);
				}
				return $res;
				
			}else{
				return false;
			}
		}else{
			echo "<div class='error'>Usted no tiene los permisos necesarios para poder modificar datos.</div>";
			return false;
		}
	}

	/*
	 * evitarComillas
	 * 
	 * Esta funci�n recibe una cadena de caracteres y evita el mal uso de las comillas
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	evitarComillas
	 * @package	DeSeRP
	 * @return	string
	 * @version	0.8
	 * @since	0.8
	 * @param	string $s Cadena a convertir
	 */	
	private function evitarComillas($s){
		return str_replace(",","",str_replace("$","",str_replace('"',"'",$s)));
	}
	
	/*
	 * ec
	 * 
	 * Versi�n simplificada de evitarComillas.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	ec
	 * @package	DeSeRP
	 * @return	string
	 * @version	0.8
	 * @since	0.8
	 * @param	string $s Cadena a convertir
	 */
	private function ec($s){ return $this->evitarComillas($s); }
	
	/*
	 * insertar
	 * 
	 * Esta function inserta los datos recibidos en la tabla.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	insertar
	 * @package	DeSeRP
	 * @return	int
	 * @version	0.1
	 * @since	0.1
	 * @param	string $tabla Nombre de la tabla
	 * @param 	array|string $arr_datos Arreglo con los datos a insertar
	 * @param	array|string $campos Arreglo con los campos especificos a insertar
	 * @param	bool $permiso Ignorar los permisos asignados y realizar la acci�n
	 */
	public function insertar($tabla,$arr_datos,$campos = array(""), $permiso = false, $imprimir = false){
	
		$esp = "";
		if( $_SESSION['usuario']['area'][$_REQUEST['b']] >= 2 || $permiso){
			if(sizeof($campos)>1){
			$esp = "(";
				foreach($campos as $campo){
					$esp.= $campo.",";
				}
				$esp = substr($esp, 0,-1);
			$esp .= ")";
			}
			$dats = "(";
				foreach($arr_datos as $dato){
                    if(is_array($dato)){
                        $dato = implode("|", $dato);
                    }
					$dato = str_replace("\"", "\\\"", $dato);
					$dats.= "\"".$dato."\",";
				}
				$dats = substr($dats, 0,-1);
			$dats .= ")";
			$sql = "INSERT INTO ".$tabla." ".$esp." VALUES ".$dats;
			if($imprimir){
				echo $sql;
			}else{
				$res = $this->query($sql);
			}
			return mysql_insert_id($this->con)>0?mysql_insert_id($this->con):$res;
		}else{
			echo "<div class='error'>Usted no tiene los permisos necesarios para poder guardar datos.</div>";
			return false;
		}
	}
	
	/*
	 * obtenerTabla
	 * 
	 * Esta function se encarga de mostrar los resultados de la consulta en forma de tabla
	 * con posibilidad de generar enlaces hacia otra opci�n.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	obtenerTabla
	 * @package	DeSeRP
	 * @return	string
	 * @version	0.1
	 * @since	0.3
	 * @param	string $tabla Tabla a consultar
	 * @param 	array|null $campos Campos solicitados y en caso de un subarreglo enlace
	 * @param	array|null $campos_mostrar Texto que mostraran los campos 
	 * @example obtenerTabla("usuarios", array("ID", "CONCAT_WS(' ',NOMBRE,APELLIDO_P,APELLIDO_M)", "grupo", array("usuarios",0, "checkbox") ), array(1 => "Nombre", 3 => "Seleccionar") )
	 */
	public function obtenerTabla($tabla, $campos = array(), $campos_mostrar = array(), $where = "", $orden = array("no_establecido", "ASC"), $limite = ""){
		if($campos[0] != ""){
			foreach($campos as $campo){ 
				if(is_array($campo) && sizeof($campo) != 3){ $camp .= $campo[0].",";
				}else if(is_array($campo) && sizeof($campo) == 3){ $camp .= "' ',";
				}else{$camp .= $campo.",";}
			}
		}else{$camp = "* ";}
		if($orden[0] != "no_establecido"){
			$orderBy = " ORDER BY `".$orden[0]."` ".$orden[1];
		}else{
			$orderBy = "";
			if(isset($_REQUEST['orden'])){
				$orderBy = " ORDER BY `".$_REQUEST['campo']."` ".$_REQUEST['orden'];
			}
		}
		
		$camp = substr($camp, 0,-1);
		$sql = "SELECT ".$camp." FROM ".$tabla." WHERE 1 ".$where." ".$orderBy." ".$limite;
		$res = $this->query($sql);
		if($res && $this->cantidad($res) > 0){
			$fila = mysql_fetch_assoc($res);
			$r.= "<br style='clear:both' /><table class='datos tbldatos table' width='100%' style='clear:both;'><thead><tr>";
			if(sizeof($campos_mostrar) > 0){
				$encabezado = array_keys($fila);
				for($var_actual = 0; $var_actual < sizeof($encabezado); $var_actual++){
					$campo = (strlen($campos_mostrar[$var_actual])>0?$campos_mostrar[$var_actual]:$encabezado[$var_actual]);
					$ca = $campos[$var_actual];
					if(!is_array($ca)){
						$r .= "<th nowrap>".$campo."</th>";
					}else{
						$r .= "<th>".$campo."</th>";
					}
				}
			}else{
				foreach($fila as $campo => $valor){
					$r .= "<th nowrap>".$campo."</th>";
				}
			}
			foreach($fila as $campo => $valor){
				$nombre[] = $campo;
			}
			$r.= "</tr></thead><tbody>";
			do{
				$r.= "<tr>";
				for($i=0; $i< sizeof($fila); $i++){
					if(is_array($campos[$i]) && sizeof($campos[$i]) == 3 ){
						if($campos[$i][2] == "radio"){
							$r .= "<td class='".$nombre[$i]."'><label><input type='radio' name='".$campos[$i][0]."' value='".$fila[$nombre[$campos[$i][1]]]."' /> </label></td>";
						}else{
							$r .= "<td class='".$nombre[$i]."'><label><input type='checkbox' name='".$campos[$i][0]."[]' value='".$fila[$nombre[$campos[$i][1]]]."' /> </label></td>";
						}
					}else if(is_array($campos[$i])){
						$r .= "<td class='".str_replace('_',' ',$nombre[$i])."'><a href='".str_replace('"',"",str_replace("'","",$campos[$i][0]))."/".$fila[$nombre[$campos[$i][1]]]."'>".str_replace('_',' ',$fila[$nombre[$i]])."</a></td>";
					}else{
						$r .= "<td>".$fila[$nombre[$i]]."</td>";
					}
				}
				$r.= "</tr>";
			}while($fila = mysql_fetch_assoc($res));
			$r.= '</tbody></table>';
		}else{
			$r = "<div class='info'>No hay datos que mostrar.</div>";
			return $r;
		}
		return $r;
	}
	
	/*
	 * obtenerTablaSQL
	 * 
	 * Esta function, al igual que la funci�n obtenerTabla, obtiene los datos en manera de
	 * tabla, con la diferencia de recibir el SQL deseado.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	obtenerTablaSQL
	 * @package	DeSeRP
	 * @return	string
	 * @version	0.5
	 * @since	0.5
	 * @param	string $sql SQL a ejecutar
	 * @param 	array|null $campos Campos solicitados y en caso de un subarreglo enlace
	 */
	public function obtenerTablaSQL($sql, $campos = array() ){
		
		$res = $this->query($sql);
		if($res && $this->cantidad($res) > 0){
			$fila = mysql_fetch_assoc($res);
			$r.= "<br style='clear:both' /><table class='datos tbldatos table' width='100%' style='clear:both;'><thead><tr>";
				foreach($fila as $campo => $valor){
					$r .= "<th nowrap>".$campo."</th>";
				}
			foreach($fila as $campo => $valor){
				$nombre[] = $campo;
			}
			$r.= "</tr></thead><tbody>";
			
			do{
				$r.= "<tr>";
				for($i=0; $i< sizeof($fila); $i++){
					if(is_array($campos[$i])){
						$r .= "<td class='".$nombre[$i]."'><a href='".str_replace('"',"",str_replace("'","",$campos[$i][0]))."/".$fila[$nombre[$campos[$i][1]]]."'>".$fila[$nombre[$i]]."</a></td>";
					}else{
						$r .= "<td>".$fila[$nombre[$i]]."</td>";
					}
				}				
				$r.= "</tr>";
			}while($fila = mysql_fetch_assoc($res));
			$r.= '</tbody></table>';
		}else{
			$r = "<div class='info'>No hay datos que mostrar.</div>";
			return $r;
		}
		return $r;
		
	}

	/*
	 * obtenerTablaSP
	 * 
	 * Esta function, al igual que la funci�n obtenerTabla, obtiene los datos en manera de
	 * tabla, con la diferencia de recibir el StoredProcedure.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @author	Claudia Guerrero <c.guerrero@depotserver.com>
	 * @name	obtenerTablaSP
	 * @package	DeSeRP
	 * @return	string
	 * @version	1.0
	 * @since	1.0
	 * @param	string $sp SP a ejecutar
	 * @param 	array|null $campos Campos solicitados y en caso de un subarreglo enlace
	 */
	public function obtenerTablaSP($sp, $campos = array() ){
		$res = $this->call($sp,$campos);
		if($res && $this->cantidad($res) > 0){
			$fila = mysql_fetch_assoc($res);
			$r.= "<br style='clear:both' /><table class='datos tbldatos' width='100%' style='clear:both;'><thead><tr>";
				foreach($fila as $campo => $valor){
					$r .= "<th nowrap>".$campo."</th>";
				}
			foreach($fila as $campo => $valor){
				$nombre[] = $campo;
			}
			$r.= "</tr></thead><tbody>";
			
			do{
				$r.= "<tr>";
				for($i=0; $i< sizeof($fila); $i++){
					if(is_array($campos[$i])){
						$r .= "<td class='".$nombre[$i]."'><a href='".str_replace('"',"",str_replace("'","",$campos[$i][0]))."/".$fila[$nombre[$campos[$i][1]]]."'>".$fila[$nombre[$i]]."</a></td>";
					}else{
						$r .= "<td>".$fila[$nombre[$i]]."</td>";
					}
				}				
				$r.= "</tr>";
			}while($fila = mysql_fetch_assoc($res));
			$r.= '</tbody></table>';
		}else{
			$r = "<div class='info'>No hay datos que mostrar.</div>";
			return $r;
		}
		return $r;
		
	}
	
	/*
	 * login
	 * 
	 * Esta function realiza, de manera segura, la validaci�n de ingreso al sistema.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	login
	 * @package	DeSeRP
	 * @return	mysql_result
	 * @version	0.1
	 * @since	0.1
	 * @param	string $usuario Nombre del usuario
	 * @param 	string $password Contrase�a del usuario
	 */
	public function login($usuario,$password){
		//$sql = "SELECT * FROM usuarios WHERE md5(usuario) = md5('".strtoupper($usuario)."') AND password = '".md5($password)."'";
		//return $this->query($sql);
		return $this->con::table('usuarios')->where([ ['usuario', 'like', strtoupper($usuario)], ['password', 'like', md5($password)] ])->first();
	}

	/*
	 * obtenerPermisos
	 * 
	 * Esta function obtiene los permisos a los m�dulos a los cuales el usuario tiene acceso.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	obtenerPermisos
	 * @package	DeSeRP
	 * @return	mysql_result
	 * @version	0.1
	 * @since	0.1
	 */	
	public function obtenerPermisos(){
		//$sql = "SELECT * FROM Usuarios_Permisos WHERE idUsuario = ".$_SESSION['usuario']['id']. " UNION SELECT ".$_SESSION['usuario']['id'].", 'principal', '3' ORDER BY `modulo` ASC";
		//return $this->res = $this->query($sql);
		return $this->con::table('usuarios_permisos')->where([ ['idUsuario', '=', $_SESSION['usuario']['id'] ] ])->get();
	}
	
	/*
	 * cantidad
	 * 
	 * Esta function regresa la cantidad de datos que arrojo la consulta.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	cantidad
	 * @package	DeSeRP
	 * @return	int
	 * @version	0.1
	 * @since	0.1
	 * @param	mysql_result $res Resultado de la consulta
	 */
	public function cantidad($res){
		if($res && mysql_num_rows($res)>0){
			return mysql_num_rows($res);
		}else{
			return 0 ;
		}
	}
	
	/*
	 * log
	 * 
	 * Esta function registra el movimiento en la plataforma.
	 *
	 * @access	public
	 * @since	0.1_beta
	 * @author	Mauricio Vera <m.vera@depotserver.com>
	 * @name	log
	 * @package	DeSeRP
	 * @version	0.2
	 * @since	0.2
	 * @param	int $id Id del usuario
	 * @param 	string $area Informaci�n serializada de la petici�n
	 * @param	date $fecha Momento en el cual se realiza el registro
	 */
	public function log($id, $area, $fecha){
		$this->insertar("Accesos", array($id,$area,$fecha), array(""), true);
	}
	
	public function info(){
		return mysql_info($this->con);
	}

	public function error(){
		return mysql_error($this->con);
	}
	
}?>