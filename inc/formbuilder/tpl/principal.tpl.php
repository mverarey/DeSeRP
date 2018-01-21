<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">DSFormBuilder</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary version">v. 3.6</span>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">

<div class="col-xs-12 col-sm-5">

	<div class="form-group">
		<p>Seleccione la tabla de la base de datos:</p>
		<select name="tabla" id="tabla" class="form-control"><option>Cargando tablas..</option></select>
		<span>No discrimina entre Tablas y Vistas</span>
	</div>

	<h3>Administrador</h3>

	<div class="form-group">
		<label>Nombre del OBJETO:</label>
		<input type="text" id="txtObjeto" class="form-control" />
		<span class="help-block">Por ejemplo: Seleccione {OBJETO} y despu&eacute;s</span>
	</div>
	<div class="form-group">
		<label>Nombre de los OBJETOS:</label>
		<input type="text" id="txtObjetos" class="form-control" />
		<span class="help-block">Por ejemplo: Administrador de {OBJETOS}</span>
	</div>

  <div id="divColumnas"></div>

	<h3>Menú</h3>

	<div class="form-group has-feedback">
		<label>Ícono</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-archive" id="iconovisual"></i></span>
			<input type="text" id="txtIcono" class="form-control" value="archive" />
			<a href="http://fontawesome.io/icons/" target="_blank" class="input-group-addon btn btn-default">Lista <i class="fa fa-share"></i></a>
		</div>
	</div>

	<div class="form-group">
		<label>Nombre a mostrar:</label>
		<span class="help-block pull-right" style="font-size: 0.8em">opcional</span>
		<input type="text" id="txtNombre" class="form-control" />
	</div>


	<h3>Plugins</h3>
	<div class="checkbox">
	    <label>
	      <input type="checkbox" name="exportarExcel" id="txtexportarExcel" value="1"> Exportador a excel
	    </label>
	  </div>
	  <div class="checkbox">
	    <label>
	      <input type="checkbox" name="instalar" id="txtinstalar" value="1"> Instalar automaticamente <div style="font-size:0.8em; color:#F00;">Esto reemplazara el módulo actual.</div>
	    </label>
	  </div>

	<br style="clear:both" />

	<input type="button" value="Generar m&oacute;dulo" id="btnGenerar" style="float:right" class="btn btn-default" />
</div>

<div class="col-xs-12 col-sm-7" style="font-size: 0.8em;" id="res"></div>

</div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
