<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">DSFormBuilder</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary version">v. 3.5</span>
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
	<p class="lead">Plugins</p>
	<div class="checkbox">
	    <label>
	      <input type="checkbox" name="exportarExcel" id="txtexportarExcel" value="1"> Exportador a excel
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