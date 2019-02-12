<ul>
	<li><a href="#UploadManager">UploadManager</a></li>
	<li><a href="#DSUploader">DSUploader</a></li>
</ul>

<h2 id="UploadManager">UploadManager</h2>
<div class="row">
	<div class="col-md-6">
		<h3>WSDL Route</h3>
		<pre><code>$app->any('/upload/{params:.*}', RoutesController::class . ':upload');</code></pre>
	</div>
	<div class="col-md-6">
		<h3>Response</h3>
		<pre><code>{"files":[
		{
			"name":"ARCHIVO.png",
			"size":316034,
			"url":"http:\/\/localhost\/tmp\/upload\/usuarios\/1\/ARCHIVO.png",
			"thumbnailUrl":"http:\/\/localhost\/tmp\/upload\/usuarios\/1\/thumbnail\/ARCHIVO.png",
			"deleteUrl":"http:\/\/localhost\/index.php?file=ARCHIVO.png",
			"deleteType":"DELETE"
		},
		]}</code></pre>
		<br/>
		<p>Detalles: <a href="https://github.com/blueimp/jQuery-File-Upload" target="_blank">https://github.com/blueimp/jQuery-File-Upload</a></p>
	</div>
</div>

<h2 id="DSUploader">DSUploader</h2>
<div class="row">
	<div class="col-md-6">
		<h3>TPL</h3>
		<pre><code>{@pag-&gt;campoCarga}</code></pre>
	</div>
	<div class="col-md-6">
		<h3>CTL</h3>
		<pre><code>$uploadCampo = \DepotServer\DSUploader::generar("TITULOCAMPO", "RUTA");
		$this->ev("campoCarga", $uploadCampo["campo"]);
		$this->agregarScript($uploadCampo["script"]);</code></pre>
	</div>
	<div class="col-md-6">
		<h3>HTML</h3>
		<span class="btn btn-success btn-block fileinput-button">
	<i class="glyphicon glyphicon-plus"></i>
	<span>Seleccione el archivo deseado...</span>
	<input id="fileuploadlogotipo" type="file[]" name="logotipo">
</span>
	</div>
	<div class="col-md-6">
		<h3>Resultado</h3>
		<p>Archivo se carga en RUTA. <br/>Por ejemplo: $uploadCampo = \DepotServer\DSUploader::generar("TITULOCAMPO", "upload/usuarios/");<br/> Archivo se carga en /tmp/upload/usuarios/IDSESION/{archivo}</p>
	</div>
</div>
