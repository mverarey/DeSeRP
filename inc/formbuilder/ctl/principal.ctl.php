<?
$this->establecerTitulo("Generador de formularios");

$c = new DepotServer\Conexion();

// Depot
//$c = new Conexion('depotserver.com', 'depot', 'eahv790802;', 'depot_cw');

// CNNM
//$c = new Conexion('vps.depotserver.com', 'depotser_annm', '1o]k4&f_T~de16Fb7h', 'depotser_annm');

// Fovissste
//$c = new Conexion('depotserver.com', 'depot', 'eahv790802', 'depot_fovissste');

// Human 360
//$c = new Conexion('gruporuz.human360.depotserver.com', 'human360_ruz', '#SmsP=O%thJOticD0(', 'human360_ruz');

// Probiomed
//$c = new Conexion('cap-probiomed.com.mx', 'capacita_ds', 'w+-%dTtA*D2B1(D{-5', 'capacita_probiomed2008');

// CNNM
//$c = new Conexion('vps.depotserver.com', 'depotser_annm', '1o]k4&f_T~de16Fb7h', 'depotser_annm');

// BADGES
//$c = new Conexion('badges.mauriciovera.com', 'badgesma_DeSeRPu', 'W,iZpmG~y@BBIKp@e8', 'badgesma_DeSeRP');

//$c = new Conexion('dep.depotserver.com', 'concurso_wp_user', '_t?=8H2Qu;G#[M}T#$', 'concurso_wp');

//$c = new Conexion('dep.depotserver.com', 'depot', 'eahv790802;', 'depot_annm');

//$c = new Conexion("uinl.preregistros.com.mx", 'uinlprer_user',  'pgfTvGZ!Pd5T[Wgen2', "uinlprer_wp");

//$c = new DepotServer\Conexion("localhost", 'depotse1_farmasa',  '@P!t!Fe%W,uvlOhfBN', "depotse1_farmasa");

$oss = array($this->os(1),$this->os(2),$this->os(3),$this->os(4));

switch($this->os(4)){

	case "tablas":
		$tables = $c->query('SHOW TABLES');
		foreach($tables as $table)
		{
			foreach ($table as $key => $value){
				$tbls .= "<option value='".$value."'>".$value."</option>";
			}
		}
		echo $tbls;
	break;

	case "generar":	
	
		function rrmdir($dir) {
		   if (is_dir($dir)) {
			 $objects = scandir($dir);
			 foreach ($objects as $object) {
			   if ($object != "." && $object != "..") {
				 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			   }
			 }
			 reset($objects);
			 rmdir($dir);
		   }
		}
		
		function crear_zip($files = array(),$destination = '',$rutaRemplazar = '',$overwrite = true) {
		  if(file_exists($destination) && !$overwrite) { return false; }
		  $valid_files = array();
		  if(is_array($files)) {
			foreach($files as $file) {
			  if(file_exists($file)) {
				$valid_files[] = $file;
			  }
			}
		  }
		  if(count($valid_files)) {
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			  return false;
			}
			foreach($valid_files as $file) {
			  $zip->addFile($file,str_replace($rutaRemplazar,"",$file));
			}
			$zip->close();
			return file_exists($destination);
		  }
		  else
		  {
			return false;
		  }
		}
		
		$exportar = $_REQUEST['exportar'] == "true";
		$tabla = $this->os(5);
		if($tabla != ""){
			echo "<ul class='nostyle'>";
			$noV = array("_", "$");
			$val = array("", "");
			$mod = str_replace($noV, $val, strtolower($tabla));
			$ruta = dirname(__FILE__)."/../../../tmp/formbuilder";
			$rutaTpls = dirname(__FILE__)."/../assets";
			if(!is_dir($ruta)){
				if(mkdir($ruta)){
					echo "<li><i class='glyphicon glyphicon-ok'></i> Carpeta principal creada: ".$carpeta."</li>";
				}
			}
			if(is_dir($ruta)){
				echo "<li>Creando carpetas...<ul>";
				if(is_dir($ruta."/".$mod)){
					$dir = $ruta."/".$mod;
					rrmdir($dir);
					echo "<li><i class='glyphicon glyphicon-ok'></i> Carpetas anteriores eliminadas</li>";
				}
				$carpetas = array( $mod, $mod."/ctl", $mod."/tpl" );
				foreach($carpetas as $carpeta){
					if(mkdir($ruta."/".$carpeta)){
						echo "<li><i class='glyphicon glyphicon-ok'></i> Carpeta creada: ".$carpeta."</li>";
					}else{
						$this->msgError("No se pudo crear la carpeta: ".$carpeta);
						exit;
					}
				}
				echo "</ul></li><li>Generando archivos...<ul>";

				$exportartpl = "";
				if($exportar){
					$frms = array("{TABLA}");
					$plantillaexptpl = file_get_contents($rutaTpls."/plantillaexpctl.txt");
					echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla exportar cargada</li>";
					$plantillaexptpl = str_replace($frms, array($tabla), $plantillaexptpl );
					echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
					file_put_contents($ruta."/".$mod."/ctl/exportar.ctl.php", $plantillaexptpl);
					echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo exportar generado</li>";
					unset($plantillaexptpl);
					$exportartpl = "<a href='/wsdl/".$tabla."/exportar' class='btn btn-default'><i class='fa fa-download'></i> Exportar</a>";
				}








				$frms = array("{HASH}","{OBJETO}","{CAMPOSC}", "{CAMPOSM}", "{COLUMNAS}","{EXPORTAR}", "{TABLA}");
				/*
				 * CAMPOSC
				 * <label for="txtfechater">Fecha de t&eacute;rmino *</label>
				 * <input id="txtfechater" type="text" class="datetime required" name="txtfechater" />
				 *
				 * CAMPOSM
				 * <label for="txtfechater">Fecha de t&eacute;rmino *</label>
				 * <input id="dtxtfechater" type="text" class="datetime required" name="txtfechater" />
				 */ 
				$res = $c->query("SHOW COLUMNS FROM ".$tabla);
				if($c->cantidad($res) > 0){
					foreach ($res as $f) {
						$f = get_object_vars($f);
						if($f['Field'] == "id" || ($f['Key'] == "PRI" && $f['Extra'] == "auto_increment") ){ 
							$camposi .= " NULL, ";
							$camposo .= " \$(\"#idObjeto\").val(data.id); \n";
							$campost .= '"'.$f['Field'].'", ';
							$columnas .= "\t\t".'<th data-field="'.$f['Field'].'" data-sortable="true">No</th>'."\n";
							$where .= " ".$f['Field']." LIKE \"'.\$search.'\" ";
						}else{
							$camposc .= '<div class="form-group">'."\n\t".'<label for="txt'.$f['Field'].'" class="col-sm-2 control-label">'.$f['Field'].'</label>'."\n";
							$camposc .= "\t".'<div class="col-sm-10">'."\n\t\t".'<input id="txt'.$f['Field'].'" name="txt'.$f['Field'].'" type="text" class="form-control" placeholder="'.$f['Field'].'" />'."\n\t</div>\n</div>\n";
							//$camposc .= '<label for="txt'.$f['Field'].'">'.$f['Field'].'</label>'."\n";
							//$camposc .= '<input id="txt'.$f['Field'].'" type="text" class="" name="txt'.$f['Field'].'" />'."\n";
							$camposm .= '<div class="form-group">'."\n\t".'<label for="dtxt'.$f['Field'].'" class="col-sm-2 control-label">'.$f['Field'].'</label>'."\n";
							$camposm .= "\t".'<div class="col-sm-10">'."\n\t\t".'<input id="dtxt'.$f['Field'].'" type="text" class="form-control" name="txt'.$f['Field'].'" />'."\n\t".'</div>'."\n".'</div>'."\n";
							//$camposm .= '<label for="dtxt'.$f['Field'].'">'.$f['Field'].'</label>'."\n";
							//$camposm .= '<input id="dtxt'.$f['Field'].'" type="text" class="" name="txt'.$f['Field'].'" />'."\n";
							
							$campost .= '"'.$f['Field'].'", ';
							$camposi .= " \$_REQUEST['txt".$f['Field']."'], ";
							$camposa .= " \"".$f['Field']."\" => \$_REQUEST['".$f['Field']."'], ";
							$camposo .= " \$(\"#dtxt".$f['Field']."\").val(data.".$f['Field']."); ";
							
							$camposun[] = '"'.$f['Field'].'"';
							$camposuv[] = '"dtxt'.$f['Field'].'"';

							$columnas .= "\t\t".'<th data-field="'.$f['Field'].'" data-sortable="true" data-visible="true">'.ucwords($f['Field']).'</th>'."\n";
							$where .= " OR ".$f['Field']." LIKE \"%'.str_replace(' ','%',\$search).'%\" ";
							$where3 .= "->orWhere('".$f['Field']."', 'like', \$search)";
						}
					}
					$camposun = implode(",", $camposun);
					$camposuv = implode(",", $camposuv);

					echo "<li><i class='glyphicon glyphicon-ok'></i> Campos generados</li>";
				}else{
					$this->msgError("No cuenta con columnas la tabla.");
					exit;
				}


				$plantillatpl = file_get_contents($rutaTpls."/plantillatpl.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla TPL cargada</li>";
				$plantillatpl = str_replace($frms, array(md5($tabla),$_REQUEST['objeto'], $camposc, $camposm, $columnas, $exportartpl, $tabla), $plantillatpl );
				echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
				file_put_contents($ruta."/".$mod."/tpl/administracion.tpl.php", $plantillatpl);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo TPL generado</li>";
				unset($plantillatpl);
				
				$frms = array("{TABLA}","{HASH}","{OBJETO}", "{OBJETOS}", "{CAMPOS}", "{INSERTAR}", "{ACTUALIZAR}", "{MODIFICAR}", "{CAMPOSUN}", "{CAMPOSUV}");
				/*
				 * INSERTAR
				 * 'NULL', $_REQUEST['txtclave'], 1, $_REQUEST['txtnombre'], $_REQUEST['txtfechaini'], $_REQUEST['txtfechater']
				 *
				 * ACTUALIZAR
				 * "idObjeto" => $_REQUEST['idObjeto'],
					"nombre" => $_REQUEST['txtnombre'],
					"fecha_inicio" => $_REQUEST['txtfechaini'],
					"fecha_termino" => $_REQUEST['txtfechater'] 
					
				 * MODIFICAR
				 * $("#idObjeto").val(data.id);
					$("#dtxtnombre").val(data.nombre);
					$("#dtxtfechaini").val(data.fecha_inicio);
					$("#dtxtfechater").val(data.fecha_termino);
					$("#dtxtclave option[value='"+data.idObjeto+"']").attr("selected", "selected");
				 *				  
				 */				
				$plantillactl = file_get_contents($rutaTpls."/plantillactl.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla CTL cargada</li>";
				$plantillactl = str_replace($frms, array($tabla, md5($tabla), $_REQUEST['objeto'], $_REQUEST['objetos'], $campost, $camposi, $camposa, $camposo, $camposun, $camposuv), $plantillactl );
				echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
				file_put_contents($ruta."/".$mod."/ctl/administracion.ctl.php", $plantillactl);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo CTL generado</li>";
				unset($plantillactl);
				
				

				$frms = array("{TABLA}","{HASH}","{OBJETO}", "{OBJETOS}", "{CAMPOS}", "{INSERTAR}", "{ACTUALIZAR}", "{MODIFICAR}", "{CAMPOSUN}", "{CAMPOSUV}");
				$plantillactl = file_get_contents($rutaTpls."/plantillacontrolador.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla Controlador cargada</li>";
				$plantillactl = str_replace($frms, array($tabla, md5($tabla), $_REQUEST['objeto'], $_REQUEST['objetos'], $campost, $camposi, $camposa, $camposo, $camposun, $camposuv), $plantillactl );
				echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
				file_put_contents($ruta."/".$mod."/ctl/controlador.ctl.php", $plantillactl);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo Controlador generado</li>";
				unset($plantillactl);





				$frms = array("{TABLA}","{OBJETO}", "{OBJETOS}", "{CAMPOS}", "{INSERTAR}", "{ACTUALIZAR}", "{MODIFICAR}");
				$plantillaobt = file_get_contents($rutaTpls."/plantillaobt.txt");
				$plantillaobt = str_replace($frms, array($tabla, $_REQUEST['objeto'], $_REQUEST['objetos'], $campost, $camposi, $camposa, $camposo), $plantillaobt );
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla OBT cargada</li>";
				$plantillaobt = str_replace($frms, array($tabla), $plantillaobt);
				file_put_contents($ruta."/".$mod."/ctl/obtenerobjetos.ctl.php", $plantillaobt);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo OBT generado</li>";
				unset($plantillaobt);

				$frms = array("{TABLA}","{HASH}","{WHERE}");
				$plantillaobttab = file_get_contents($rutaTpls."/plantillaobttab.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla OBTTAB cargada</li>";
				$plantillaobttab = str_replace($frms, array($tabla, md5($tabla), $where3), $plantillaobttab );
				file_put_contents($ruta."/".$mod."/ctl/obtenertabla.ctl.php", $plantillaobttab);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo OBTTAB generado</li>";
				unset($plantillaobttab);

				$plantillamenu = array( "nombre" => $mod, "icono" => "archive", "elementos" => array("Administración" => "/app/".$mod."/administracion") );
				file_put_contents($ruta."/".$mod."/data.json", json_encode($plantillamenu));
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo data generado</li>";
				unset($plantillaobttab);



				
				echo "</ul></li>";
				
				$files_to_zip = array(
				  $ruta.'/'.$mod.'/ctl/administracion.ctl.php',
				  $ruta.'/'.$mod.'/ctl/obtenerobjetos.ctl.php',
				  $ruta.'/'.$mod.'/ctl/obtenertabla.ctl.php',
				  $ruta.'/'.$mod.'/ctl/controlador.ctl.php',
				  $ruta.'/'.$mod.'/tpl/administracion.tpl.php',
				);
				if($exportar){ $files_to_zip[] = $ruta.'/'.$mod.'/ctl/exportar.ctl.php'; }

				$zip = crear_zip($files_to_zip,$ruta.'/'.$mod.'.zip', $ruta);
				if($zip == 1){
					if(is_dir($ruta."/".$mod)){
						$dir = $ruta."/".$mod;
						rrmdir($dir);
						echo "<li><i class='glyphicon glyphicon-ok'></i> Carpetas eliminadas</li>";
					}
				}
				echo "<li><i class='glyphicon glyphicon-ok'></i> Zip Generado</li>";

			}else{
				throw new Exception("No hay carpeta destino configurada.");
			}
			echo "</ul>";
			
			echo "<a class='btnDescargar btn btn-success' href='/tmp/formbuilder/".$mod.".zip?v=".date("Ymdhis")."'><i class='glyphicon glyphicon-save'></i> Descargar</a>";
			echo "<p style='font-size:8px; text-align:right;'>versi&oacute;n: 2017</p>";
		}
	break;

	default:
		
	break;
}

$script = <<<EOM
$.ajax({
  url: "/wsdl/{$oss[1]}/{$oss[2]}/tablas",
  success: function(data){
    $("#tabla").html(data);
  }
});

$("#btnGenerar").click(function(){
	$("#res").html("Generando...");
	$.ajax({
	  url: "/wsdl/{$oss[1]}/{$oss[2]}/generar/"+$("#tabla").val(),
	  data: "objeto="+$("#txtObjeto").val()+"&objetos="+$("#txtObjetos").val()+"&exportar="+$("#txtexportarExcel").is(':checked'),
	  type: "POST",
	  success: function(data){
		$("#res").html(data);
	  }
	});
});
EOM;
$this->agregarScript($script);
?>