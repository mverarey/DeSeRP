<?php namespace DepotServer;

/**
 * DSUploader
 *
 * Funciones para generar uploaders
 *
 * @access       public
 * @author       Mauricio Vera <m.vera@depotserver.com>
 * @copyright    DepotServer 2019
 * @name         DS Uploader
 * @since		3.5
 * @version		3.5
 */
class DSUploader{

	public static function generar($name, $url = '/tmp/upload/', $multiple = false){

		$name_real = $name;
		$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);

		$archivos = $multiple ? "los archivos deseados" : "el archivo deseado";
		$multipleLabel = $multiple ? "multiple"  : "";

		$campo = <<<EOM
<span class="btn btn-success fileinput-button">
	<i class="glyphicon glyphicon-plus"></i>
	<span>Seleccione $archivos...</span>
	<input id="fileupload$name" type="file" name="files[]" $multipleLabel />
</span>
<br>
<div id="progress$name" class="progress">
    <div class="progress-bar progress-bar-success"></div>
</div>
<input type="hidden" name="$name_real" id="$name" />
<div id="fd$name" class="files"></div>
<!-- <div id="dropzone" style="width:100%; height:300px; background-color: #FFF; text-align:center;">AREA DE ENTREGA</div>-->
EOM;


		$script = <<<EOM
$('#fileupload$name').fileupload({
	url: '$url', dataType: 'json',
	done: function (e, data) {
		var filesURL = "";
		$.each(data.result.files, function (index, file) {
			if(file.url.length > 0){
				filesURL += file.url + "|";
				/* console.log(file.name); */
				$("#fd$name").append("<div class='alert alert-success'><p><i class='fa fa-check'></i> "+ file.name +"</p></div>");
			}else{
				console.log(file.name + " - Archivo no permitido");
				$("#fd$name").append("<div class='alert alert-danger'><p><i class='fa fa-times'></i> "+ file.name +"</p></div>");
			}
		});
		$("#$name").val( filesURL.slice(0, -1) );
	},
	progressall: function (e, data) {
		var progress = parseInt(data.loaded / data.total * 100, 10);
		$('#progress$name .progress-bar').css(
			'width',
			progress + '%'
		);
	}
}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
EOM;

		return [
			"campo" => $campo,
			"script" => $script
		];

	}

}