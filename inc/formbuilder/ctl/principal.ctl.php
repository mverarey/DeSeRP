<?
use DepotServer\BaseDatos;
$bd = new BaseDatos();

$this->establecerTitulo("Generador de formularios");

$oss = array($this->os(1),$this->os(2),$this->os(3),$this->os(4));

switch($this->os(4)){

	case "tablas":
		$tables  = $bd::select( "SHOW TABLES" );
		$tbls = "<option>-- Selecciona una opción --</option>";
		foreach($tables as $table)
		{
			foreach ($table as $key => $value){
				$tbls .= "<option value='".$value."'>".$value."</option>";
			}
		}
		echo $tbls;
	break;

	case "detalle":
		$tabla = $this->os(5);
		$columns = $bd::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "'.$tabla.'" AND COLUMN_KEY IN ("PRI", "MUL") ');

		$rel = [];
		$columnsKey = $bd::select('SELECT COLUMN_NAME, REFERENCED_TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = "'.$tabla.'" AND REFERENCED_COLUMN_NAME IS NOT NULL');
		foreach ($columnsKey as $relacion) {
			$rel[$relacion->COLUMN_NAME] = $relacion->REFERENCED_TABLE_NAME;
		}

		foreach ($columns as $column) {
			if($column->COLUMN_KEY == "PRI"){
				echo '<div class="form-group"><label>'.$column->COLUMN_NAME.'</label><p>Primary Key</p></div>';
			}else if($column->COLUMN_KEY == "MUL"){
				echo '<div class="form-group"><label>'.$column->COLUMN_NAME.'</label>';
				$tabla = $rel[$column->COLUMN_NAME];
				$columnsTable = $bd::select('SELECT TABLE_NAME, COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "'.$tabla.'" AND COLUMN_KEY <> "PRI" ');
				$columnas = "";
				foreach ($columnsTable as $columna) {
					$columnas .= "<option value='".$column->COLUMN_NAME."|".$columna->TABLE_NAME."|".$columna->COLUMN_NAME."'>".$columna->TABLE_NAME." => ".$columna->COLUMN_NAME."</option>";
				}
				echo '<select id="'.$column->COLUMN_NAME.'_rel'.'" class="form-control relaciones" >'.$columnas.'</select></div>';
			}else{
				/*
				echo '<div class="form-group">
					<label>'.$column->COLUMN_NAME.'</label>
					<select id="'.$column->COLUMN_NAME.'_rel'.'" class="form-control relaciones" ><option value="">Sin relación externa</option>';
				foreach ($columnsKey as $relacion) {
					echo "<option value='".$column->COLUMN_NAME."|".$relacion->TABLE_NAME."|".$relacion->COLUMN_NAME."'>".$relacion->TABLE_NAME.' -> '.$relacion->COLUMN_NAME."</option>";
				}
				echo '</select>
						<span class="help-block">'.$column->COLUMN_COMMENT.'</span>
				</div>';
				*/
			}
		}

	break;

	case "generar":

		function reemplazarModulo($manager, $modulo, $files){
			if( $manager->has("fs://inc/".$modulo) ){
				echo "<li><i class='glyphicon glyphicon-ok'></i> Sobreescribiendo el módulo actual</li>";
			}
			foreach($files as $file){
				if( $manager->has("fs://tmp/formbuilder/".$file) ){
					$manager->put( "fs://inc/".$file, $manager->readAndDelete("fs://tmp/formbuilder/".$file) );
				}
			}
			echo "<li><i class='glyphicon glyphicon-ok'></i> Archivos instalados</li>";
		}

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
			  if(file_exists($rutaRemplazar."/".$file)) {
				$valid_files[] = $rutaRemplazar."/".$file;
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
		$instalar = $_REQUEST['instalar'] == "true";
		$icono = strlen($_REQUEST['icono']) == 0 ? "archive": $_REQUEST['icono'];

		$relacionesReq = explode("/",$_REQUEST['relaciones']);
		$relaciones = [];
		foreach($relacionesReq as $relacion){
			if(strlen($relacion) > 0){
				$rel = explode("|", $relacion);
				$relaciones[$rel[0]] = ["tabla" => $rel[1], "columna" => $rel[2]];
			}
		}

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

				$res = $bd::select("SELECT `COLUMN_NAME` 'col_origen', `REFERENCED_TABLE_NAME` 'tbl_destino', `REFERENCED_COLUMN_NAME` 'col_destino' FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE` WHERE `TABLE_SCHEMA` = SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL AND TABLE_NAME = '".$tabla. "';");

				$ctl_scripts = "";
				$controladorFK = "";
				$fks = array();
				// Iterar relaciones
				foreach ( $res as $pos => $relacion ) {
					$relacion = get_object_vars($relacion);

					//print_r([['tabla' => $relacion['tbl_destino'], 'col_origen' => $relacion['col_origen'], 'col_destino' => $relacion['col_destino'], 'col_mostrar' => $relaciones[$relacion['col_origen']]['tabla'].'.'.$relaciones[$relacion['col_origen']]['columna'] ]]);

					$uriTabla = base64_encode(serialize([['tabla' => $relacion['tbl_destino'], 'col_origen' => $relacion['col_origen'], 'col_destino' => $relacion['col_destino'], 'col_mostrar' => $relaciones[$relacion['col_origen']]['tabla'].'.'.$relaciones[$relacion['col_origen']]['columna'] ]]));

					$fks[] = $relacion['col_origen'];

					$exportartpl = "";
					if($exportar){
						/*
						$frms = array("{TABLA}");
						$plantillaexptpl = file_get_contents($rutaTpls."/plantillaexpctl.txt");
						echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla exportar cargada</li>";
						$plantillaexptpl = str_replace($frms, array($tabla), $plantillaexptpl );
						echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
						file_put_contents($ruta."/".$mod."/ctl/exportar.ctl.php", $plantillaexptpl);
						echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo exportar generado</li>";
						unset($plantillaexptpl);
						*/
						//$exportartpl = "<a href='/wsdl/".$tabla."/exportar' class='btn btn-default'><i class='fa fa-download'></i> Exportar</a>";
						$exportartpl = "<a href='/xlsx/".str_replace("_", "", $tabla)."/?joins=".$uriTabla."' class='btn btn-default'><i class='fa fa-download'></i> Exportar</a>";
					}

					$ctl_scripts .= <<<EOM
	$("#dtxt{$relacion['col_origen']},#txt{$relacion['col_origen']}").select2({ ajax: { url: '/wsdl/{\$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_{$pos}" }; return query; } }, language: "es" });
EOM;
					$controladorFK .= <<<EOM
	case "fk_{$pos}":

		\$valor = "{$relaciones[$relacion['col_origen']]['tabla']}.{$relaciones[$relacion['col_origen']]['columna']}"; /* CAMBIAR POR CAMPO DE TEXTO */
		\$tabla = "{$relacion['tbl_destino']}"; \$columna = "{$relacion['col_destino']}"; \$idfk = \$_REQUEST['fk'];
		\$objs = \$db::table(\$tabla)->select(\$columna.' as id', \$db::raw(\$valor.' as text'));
		if(strlen(\$_REQUEST['q']) >0 ){ \$objs = \$objs->where( \$db::raw(\$valor), 'like', '%'.\$_REQUEST['q'].'%');
		}else if(strlen(\$_REQUEST['f']) >0 ){ \$objs = \$objs->where(\$columna, \$_REQUEST['f'] ); }
		\$objs = \$objs->limit(100)->get()->all();
		\$response['results'] = \$objs;

	break;
EOM;

					$camposo .= <<<EOM
	\$.ajax({ url: '/wsdl/{\$this->os(2)}/controlador/fk/fk_{$pos}/'+ data.{$relacion['col_origen']} }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxt{$relacion['col_origen']}').append(option).trigger('change'); $('#dtxt{$relacion['col_origen']}').trigger({ type: 'select2:select', params: { data: data } }); });
EOM;
				}

				/*
				 * CAMPOSC
				 * <label for="txtfechater">Fecha de t&eacute;rmino *</label>
				 * <input id="txtfechater" type="text" class="datetime required" name="txtfechater" />
				 *
				 * CAMPOSM
				 * <label for="txtfechater">Fecha de t&eacute;rmino *</label>
				 * <input id="dtxtfechater" type="text" class="datetime required" name="txtfechater" />
				 */

				$columnasBD = $bd::select("SHOW COLUMNS FROM ".$tabla);

				if(sizeof($columnasBD) > 0){
					foreach ($columnasBD as $f) {
						$f = get_object_vars($f);

						if($f['Field'] == "id" || ($f['Key'] == "PRI" && $f['Extra'] == "auto_increment") ){
							// $camposi .= " NULL, ";
							$camposo .= " \$(\"#idObjeto\").val(data.id); \n";
							$campost .= '"'.$tabla.'.'.$f['Field'].'", ';
							$columnas .= "\t\t".'<th data-field="'.$f['Field'].'" data-sortable="true">No</th>'."\n";
							$where .= " ".$f['Field']." LIKE \"'.\$search.'\" ";
						}else{
							$camposc .= "\n\t\t\t\t\t\t".'<div class="form-group">'."\n\t\t\t\t\t\t\t".'<label for="txt'.$f['Field'].'" class="col-sm-2 control-label">'.ucwords($f['Field']).'</label>'."\n";
							$camposm .= "\n\t\t\t\t\t\t".'<div class="form-group">'."\n\t\t\t\t\t\t\t".'<label for="dtxt'.$f['Field'].'" class="col-sm-2 control-label">'.ucwords($f['Field']).'</label>'."\n";

							if( ($f['Key'] == "MUL") || in_array($f['Field'], $fks) ){

								$camposc .= "\t\t\t\t\t\t\t".'<div class="col-sm-10">'."\n\t\t\t\t\t\t\t\t".'<select id="txt'.$f['Field'].'" name="txt'.$f['Field'].'" class="form-control" placeholder="'.$f['Field'].'" style="width:100%"></select>'."\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n";
								$camposm .= "\t\t\t\t\t\t\t".'<div class="col-sm-10">'."\n\t\t\t\t\t\t\t\t".'<select id="dtxt'.$f['Field'].'" type="text" class="form-control" name="txt'.$f['Field'].'" style="width:100%"></select>'."\n\t\t\t\t\t\t\t".'</div>'."\n\t\t\t\t\t\t".'</div>'."\n";

								$columnas .= "\t\t".'<th data-field="FK'.$f['Field'].'" data-sortable="true" data-visible="true">'.ucwords($f['Field']).'</th>'."\n";
							}else{
								$camposc .= "\t\t\t\t\t\t\t".'<div class="col-sm-10">'."\n\t\t\t\t\t\t\t\t".'<input id="txt'.$f['Field'].'" name="txt'.$f['Field'].'" type="text" class="form-control" placeholder="'.$f['Field'].'" />'."\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n";
								$camposm .= "\t\t\t\t\t\t\t".'<div class="col-sm-10">'."\n\t\t\t\t\t\t\t\t".'<input id="dtxt'.$f['Field'].'" type="text" class="form-control" name="txt'.$f['Field'].'" />'."\n\t\t\t\t\t\t\t".'</div>'."\n\t\t\t\t\t\t".'</div>'."\n";
								$camposo .= " \$(\"#dtxt".$f['Field']."\").val(data.".$f['Field']."); ";

								$columnas .= "\t\t".'<th data-field="'.$f['Field'].'" data-sortable="true" data-visible="true">'.ucwords($f['Field']).'</th>'."\n";
							}
							//$camposc .= '<label for="txt'.$f['Field'].'">'.$f['Field'].'</label>'."\n";
							//$camposc .= '<input id="txt'.$f['Field'].'" type="text" class="" name="txt'.$f['Field'].'" />'."\n";
							//$camposm .= '<label for="dtxt'.$f['Field'].'">'.$f['Field'].'</label>'."\n";
							//$camposm .= '<input id="dtxt'.$f['Field'].'" type="text" class="" name="txt'.$f['Field'].'" />'."\n";

							$campost .= '"'.$f['Field'].'", ';
							$camposi .= "'".$f['Field']."' => \$_REQUEST['txt".$f['Field']."'], ";
							$camposa .= " \"".$f['Field']."\" => \$_REQUEST['".$f['Field']."'], ";
							$camposun[] = '"'.$f['Field'].'"';
							$camposuv[] = '"dtxt'.$f['Field'].'"';

							$where .= " OR ".$f['Field']." LIKE \"%'.str_replace(' ','%',\$search).'%\" ";
							$where3 .= "->orWhere('".$f['Field']."', 'like', \$search)";
						}
					}
					$camposun = implode(",", $camposun);
					$camposuv = implode(",", $camposuv);

					$campost = substr($campost, 0, -2);

					echo "<li><i class='glyphicon glyphicon-ok'></i> Campos generados</li>";
				}else{
					$this->msgError("No cuenta con columnas la tabla.");
					exit;
				}

				$frms = array("{HASH}","{OBJETO}","{CAMPOSC}", "{CAMPOSM}", "{COLUMNAS}","{EXPORTAR}", "{TABLA}", "{QUERY}");
				$plantillatpl = file_get_contents($rutaTpls."/plantillatpl.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla TPL cargada</li>";
				$plantillatpl = str_replace($frms, array(md5($tabla),$_REQUEST['objeto'], $camposc, $camposm, $columnas, $exportartpl, $tabla, $uriTabla), $plantillatpl );
				echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
				file_put_contents($ruta."/".$mod."/tpl/administracion.tpl.php", $plantillatpl);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo TPL generado</li>";
				unset($plantillatpl);






				$frms = array("{TABLA}","{HASH}","{OBJETO}", "{OBJETOS}", "{CAMPOS}", "{INSERTAR}", "{ACTUALIZAR}", "{MODIFICAR}", "{CAMPOSUN}", "{CAMPOSUV}", "{FKCTL}");
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
				$plantillactl = str_replace($frms, array($tabla, md5($tabla), $_REQUEST['objeto'], $_REQUEST['objetos'], $campost, $camposi, $camposa, $camposo, $camposun, $camposuv, $ctl_scripts), $plantillactl );
				echo "<li><i class='glyphicon glyphicon-ok'></i> Campos establecidos</li>";
				file_put_contents($ruta."/".$mod."/ctl/administracion.ctl.php", $plantillactl);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo CTL generado</li>";
				unset($plantillactl);



				$frms = array("{TABLA}","{HASH}","{OBJETO}", "{OBJETOS}", "{CAMPOS}", "{INSERTAR}", "{ACTUALIZAR}", "{MODIFICAR}", "{CAMPOSUN}", "{CAMPOSUV}", "{FKCASES}");
				$plantillactl = file_get_contents($rutaTpls."/plantillacontrolador.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla Controlador cargada</li>";
				$plantillactl = str_replace($frms, array($tabla, md5($tabla), $_REQUEST['objeto'], $_REQUEST['objetos'], $campost, $camposi, $camposa, $camposo, $camposun, $camposuv, $controladorFK), $plantillactl );
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

				$frms = array("{TABLA}","{CAMPOS}");
				$plantillajson = file_get_contents($rutaTpls."/plantillajson.txt");
				echo "<li><i class='glyphicon glyphicon-ok'></i> Plantilla OBTJSON cargada</li>";
				$plantillajson = str_replace($frms, array($tabla, $campost), $plantillajson );
				file_put_contents($ruta."/".$mod."/ctl/json.ctl.php", $plantillajson);
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo OBTJSON generado</li>";
				unset($plantillajson);

				$nombre = strlen($_REQUEST['nombre']) > 0 ? $_REQUEST['nombre'] : $mod;
				$plantillamenu = array( "nombre" => $nombre, "icono" => $icono, "elementos" => array("Administración" => "/app/".$mod."/administracion") );
				file_put_contents($ruta."/".$mod."/data.json", json_encode($plantillamenu));
				echo "<li><i class='glyphicon glyphicon-ok'></i> Archivo data generado</li>";
				unset($plantillaobttab);

				echo "</ul></li>";

				$files = array(
					  $mod.'/ctl/administracion.ctl.php',
					  //$mod.'/ctl/obtenerobjetos.ctl.php',
					  //$mod.'/ctl/obtenertabla.ctl.php',
					  $mod.'/ctl/controlador.ctl.php',
					  $mod.'/ctl/json.ctl.php',
					  $mod.'/tpl/administracion.tpl.php',
					  $mod.'/data.json',
					);
				if($exportar){ $files[] = $mod.'/ctl/exportar.ctl.php'; }

				if($instalar){
					echo "<li>Instalando módulo...<ul>";
					reemplazarModulo($this->filesystem->manager, $mod, $files);
					echo "</ul></li>";
					echo "</ul>";
					$this->agregarRegistro("Instalaste el módulo   <strong>".$mod."</strong>.");
				}else{

					$zip = crear_zip($files,$ruta.'/'.$mod.'.zip', $ruta);
					if($zip == 1){
						if(is_dir($ruta."/".$mod)){
							$dir = $ruta."/".$mod;
							rrmdir($dir);
							echo "<li><i class='glyphicon glyphicon-ok'></i> Carpetas eliminadas</li>";
						}
					}
					echo "<li><i class='glyphicon glyphicon-ok'></i> Zip Generado</li>";
					echo "</ul>";
					echo "<a class='btnDescargar btn btn-success col-sm-8' href='/tmp/formbuilder/".$mod.".zip?v=".date("Ymdhis")."'><i class='glyphicon glyphicon-save'></i> Descargar</a>";
					$this->agregarRegistro("Generaste el módulo <strong>".$mod."</strong>.");

				}


				/*
				echo "<br style='clear:both'/><pre>";
				echo $camposo ;
				echo "</pre>";
				*/

			}else{
				throw new Exception("No hay carpeta destino configurada.");
			}

			echo "<p style='font-size:8px; text-align:right;'>versi&oacute;n: 2018 - 3.6</p>";
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

$("#tabla").change(function(){
	var tabla = $("#tabla").val();
	if(tabla.length > 0){
		$.ajax({
		  url: "/wsdl/{$oss[1]}/{$oss[2]}/detalle/"+tabla,
		  success: function(data){
				if( data.length > 0){
		    	$("#divColumnas").html("<h3>Columnas de <strong>"+ tabla +"</strong></h3>" + data);
				}else{
					$("#divColumnas").html("");
				}
		  }
		});
	}else{
		$("#divColumnas").html("");
	}
});

$("#btnGenerar").click(function(){

var relaciones = "";
$( ".relaciones" ).each( function( index, element ){
		var relacion = $(this).val();
		if(relacion != null){
			if( relacion.length > 0 ){
				relaciones += relacion + "/";
			}
		}
});


	$("#res").html("<i class'fa fa-spin fa-spinner'></i> Generando módulo...");
	$.ajax({
	  url: "/wsdl/{$oss[1]}/{$oss[2]}/generar/"+$("#tabla").val(),
	  data: "objeto="+$("#txtObjeto").val()+"&objetos="+$("#txtObjetos").val()+"&exportar="+$("#txtexportarExcel").is(':checked')+"&instalar="+$("#txtinstalar").is(':checked')+"&icono="+$("#txtIcono").val()+"&nombre="+$("#txtNombre").val()+"&relaciones="+relaciones,
	  type: "POST",
	  success: function(data){
		$("#res").html(data);
	  }
	});
});

$("#txtIcono").change(function(){
	$("#iconovisual").removeClass().addClass("fa").addClass("fa-"+$(this).val());
});
EOM;
$this->agregarScript($script);
?>
